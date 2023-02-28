<?php

namespace App\Services\Auth;

use App\Enums\AccountTypeEnum;
use App\Enums\TokenTypeEnum;
use App\Models\System\Identity;
use App\Models\System\User;
use App\Models\System\Workshop;
use App\Notifications\VerifyEmail;
use App\Services\System\TokenService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use TheSeer\Tokenizer\Token;

class AuthService
{
    private bool $dontSendEmail = false;

    public function __construct(
        protected TokenService $tokenService,
        protected Identity|Authenticatable $identity = new Identity()
    )
    {
        //@todo dodać logi
    }

    /** Tworzy rekord w tabeli users
     *
     * @param array $data - dane użytkownika
     * @param int $account_type - typ tworzonego konta
     *
     * @return bool null jeśli błąd
     *
     * @throws Exception
     */
    public function save(array $data, int $account_type, int $workshop_id = null): ?Identity
    {
        try {
            if (!$this->checkIfUserExists($data)) {
                // Zapis podstawowego usera
                $this->identity->uuid = $this->generateUuid();
                $this->identity->email = $data['email'];
                $this->identity->password = bcrypt($data['password']);
                $this->identity->reset_password = (bool) $workshop_id;
                $this->identity->save();
            }
            // Zapis konta typu klient
            if ($account_type == AccountTypeEnum::CLIENT) {
                $this->saveUser($data);
            } else if ($account_type == AccountTypeEnum::WORKSHOP) {
                // Zapis konta typu warsztat
                $this->saveWorkshop($data);
            } else if ($account_type == AccountTypeEnum::WORKER) {
                // Zapis konta typu pracownik
                $this->saveWorker($workshop_id);
            }
        } catch (\Exception $e) {
            throw new Exception;
            //@todo tutaj wywala exception
        }
//        $this->sendVerificationEmail();
        return $this->identity;
    }

    /** Wysyła wiadomość e-mail z linkiem potwierdzającym konto
     *
     * @return void
     */
    public function sendVerificationEmail(): void
    {
        if (!$this->dontSendEmail) {
            if ($this->identity === null) {
                $this->identity = auth()->user();
            }
            $this->identity->notify(new VerifyEmail());
        }
    }

    /** Ustawia konto jako zweryfikowane
     *
     * @return void
     */
    public function verifyMail(): void
    {
        $this->identity->email_verified_at = Carbon::now();
        $this->identity->save();
    }

    /** Wysyła wiadomość e-mail z linkiem do rejestracji
     * @param array $data
     * @return void
     */
    public function sendLinkToRegisterNewClient(array $data): void
    {
        //@todo zrobić wysyłanie linka do rejestracji jako klient -> widok rejestracji + dane w linku od jakiego warsztatu jest link
        //      + od razu utworzyć udostępnianie danych dla tego warsztatu
    }

    /** Tworzy rekord w tabeli users
     *
     * @param array $data - dane klienta
     *
     * @return ?User null jeśli błąd
     *
     * @throws Exception
     */
    public function saveUser(array $data): ?User
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->identity_id = $this->identity->id;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->logo = public_path('/images/person');
//            $user->phone = $data['phone'] ?? null;
//            $user->date_of_birth = $data['date_of_birth'] ?? null;
//            $user->city = $data['city'] ?? null;
//            $user->street = $data['street'] ?? null;
//            $user->zip_code = $data['zip_code'] ?? null;
//            $user->building_number = $data['building_number'] ?? null;
//            $user->flat_number = $data['flat_number'] ?? null;
//            $user->avatar = $data['avatar'] ?? null;
//            $user->consent_sms_notification = $data['consent_sms_notification'] ?? false;
//            $user->consent_marketing_notification = $data['consent_marketing_notification'] ?? false;
            $user->save();
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw new Exception;
        }
    }

    /** Tworzy rekord w tabeli workshops
     *
     * @param array $data - dane warsztatu
     *
     * @return ?Workshop null jeśli błąd
     *
     * @throws Exception
     */
    public function saveWorkshop(array $data): ?Workshop
    {
        // Tworzenie warsztatu
        $workshop = new Workshop();
        $workshop->identity_id = $this->identity->id;
        $workshop->uuid = $this->identity->uuid;
//            $workshop->workshops = $data['workshops'] ?? null;
//            $workshop->owners = $data['owners'] ?? null;
        $workshop->name = $data['name'];
//            $workshop->logo = $data['logo'] ?? null;
        $workshop->nip = $data['nip'];
        $workshop->regon = $data['regon'];
        $workshop->logo = public_path('/images/person');
//            $workshop->company_created_at = $data['company_created_at'] ?? null;
//            $workshop->website = $data['website'] ?? null;
//            $workshop->social_media = $data['social_media'] ?? null;
//            $workshop->additional_data = $data['additional_data'] ?? null;
        //Tworzenie subdomeny
        $workshop->save();
//            $workshop->domains()->create(['domain' => 'Warsztat_' . $workshop->id, 'tenant_id' => $workshop->id]);
        Artisan::call('tenants:migrate', [
            '--tenants' => [$workshop->id]
        ]);

        return $workshop;
    }

    /** Sprawdza czy użytkownik o podanym mailu istnieje już w bazie
     *
     * @param $data
     *
     * @return bool
     */
    private function checkIfUserExists($data): bool
    {
        $identity = Identity::where('email', '=', $data['email'])->first();
        if ($identity) {
            $this->identity = $identity;
            if ($this->identity->email_verified_at !== null) {
                $this->dontSendEmail = true;
            }
            return true;
        }
        return false;
    }

    /** Dodaje typ konta do sesji
     *
     * @return $this
     */
    public function addTypesToSession(): static
    {
        Session::forget('account_type');
        if ($this->identity->workshop) {
            Session::push('account_type', 'workshop');
        }
        if ($this->identity->user) {
            Session::push('account_type', 'client');
        }
        if($this->identity->worker) {
            Session::push('account_type', 'worker');
        }
        if ($this->identity->is_admin) {
            // jeśli admin to loguje na /admin, a tam może przelogować się na inny typ konta
            //@todo zrobić jedno konto warsztat i klient dla wszystkich adminów
            Session::forget('account_type');
            Session::push('account_type', 'admin');
            //@todo dodać do sesji random string i zrobić w db tabele admin_access, tam kolumny id:uuid:ip:datetime
        }

        return $this;
    }

    public function getType(): string
    {
        return Session::get('account_type')[0];
    }

    /** Ustawia identity dla serwisu
     *
     * @param int $id
     *
     * @return $this
     */
    public function setIdentity(int $id): static
    {
        $this->identity = Identity::find($id);

        return $this;
    }

    /** Zwraca widok dashboardu dla danego typu konta
     *
     * @return string
     */
    public function getView(): string
    {
        if (Session::get('account_type')[0] === 'admin') {
            return view('admin.pages.dashboard');
        }
        if (count(Session::get('account_type')) > 1) {
            return view('changeType');
        }
        return Session::get('account_type')[0] . '.pages.dashboard';
    }

    /** Zwraca url do widoku dashboard dla danego typu konta
     *
     * @return string
     */
    public function getRoute(): string
    {
        if (Session::get('account_type')[0] === 'admin') {
            return route('admin.dashboard');
        }
        if (count(Session::get('account_type')) > 1) {
            return route('changeType');
        }
        if (Session::get('account_type')[0] === 'worker') {
            return route('workshop.dashboard', $this->getWorkshopUuid());
        }
        return route(Session::get('account_type')[0] . '.dashboard', $this->identity->uuid);
    }

    /** Zwraca url widoku dashboard
     *
     * @return string
     */
    public function getHomeRoute(): string
    {
        $this->identity = auth()->user();
        return $this->getRoute();
    }

    /** Generuje unikalne uuid dla Identity
     *
     * @param int $length
     *
     * @return string
     */
    public function generateUuid(int $length = 10): string
    {
        while (true) {
            $uuid = Str::random($length);
            if (Identity::where('uuid', $uuid)->count() === 0) {
                return $uuid;
            }
        }
    }

    /** Zwraca token dla danego Identity
     *
     * @return mixed
     */
    public function getToken(string $device, string $ip)
    {
        return $this->tokenService->setDevice($device)->setIdentity($this->identity)->setIp($ip)->getLoginToken()->token;
    }

    /** Ustawia id Identity do sesji
     *
     * @return void
     */
    public function addIdToSession(): static
    {
        Session::put('id', $this->identity->id);

        return $this;
    }

    /** Tworzy konto dla pracownika
     *
     * @param int $workshop_id
     *
     * @return bool
     */
    public function saveWorker(int $workshop_id): bool
    {
        $record = DB::table('system.workers')
            ->where('identity_id', $this->identity->id)
            ->where('workshop_id', $workshop_id)
            ->first();

        if (!$record) {
            return DB::table('system.workers')->insert([
                'identity_id' => $this->identity->id,
                'workshop_id' => $workshop_id
            ]);
        }
        return true;
    }

    /** Zwraca UUID warsztatu
     *
     * @return void
     */
    private function getWorkshopUuid()
    {
        if ($this->identity->worker->workshop_id !== null) {
            return Workshop::where('id', $this->identity->worker->workshop_id)->first()->uuid;
        }
    }

    /** Zwraca UUID użytkownika
     *
     * @return string
     */
    public function getUuid(): string
    {
        if (Session::get('account_type')[0] == 'worker') {
            return $this->getWorkshopUuid();
        }
        return auth()->user()->uuid;
    }

    /** Zwraca informację, czy użytkownik musi zmienić hasło przy logowaniu
     *
     * @return bool
     */
    public function checkIfMustChangePassword(): bool
    {
        return $this->identity->reset_password;
    }

    /** Tworzy token logowania dla użytkownika oraz zapisuje go w sesji
     *
     * @param string $device
     * @param string $ip
     *
     * @return $this
     *
     * @throws Exception
     */
    public function setToken(string $device, string $ip): static
    {
        $token = $this->tokenService->setDevice($device)->setIdentity($this->identity)->setIp($ip)->createLoginToken();
        Session::put('token', $token);

        return $this;
    }

    /** Usuwa token logowania użytkownika oraz czyści jego sesje
     *
     * @param string $device
     * @param string $ip
     *
     * @return bool
     */
    public function logout(string $device, string $ip): bool
    {
        $this->tokenService->setDevice($device)->setIdentity($this->identity)->setIp($ip)->revokeLoginToken();
        Auth::logout();

        return true;
    }
}
