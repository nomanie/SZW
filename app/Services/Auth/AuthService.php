<?php

namespace App\Services\Auth;

use App\Enums\AccountTypeEnum;
use App\Models\System\Identity;
use App\Models\System\User;
use App\Models\System\Workshop;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthService
{
    private bool $dontSendEmail = false;

    public function __construct(
        protected Identity|Authenticatable $identity = new Identity(),
    )
    {
        //@todo dodać logi
    }

    /** Tworzy rekord w tabeli users
     * @param array $data - dane użytkownika
     * @param int $account_type - typ tworzonego konta
     * @return bool null jeśli błąd
     */
    public function save(array $data, int $account_type): ?Identity
    {
//        try{
            if (!$this->checkIfUserExists($data)) {
                // Zapis podstawowego usera
                $this->identity->uuid = $this->generateUuid();
                $this->identity->email = $data['email'];
                $this->identity->password = bcrypt($data['password']);
                $this->identity->save();
            }
            // Zapis konta typu klient
            if ($account_type == AccountTypeEnum::CLIENT) {
                $this->saveUser($data);
            } else {
                // Zapis konta typu warsztat
                $this->saveWorkshop($data);
            }
//        } catch(\Exception $e) {
//            return null;
//        }
        $this->sendVerificationEmail();
        return $this->identity;
    }

    public function sendVerificationEmail(): void
    {
        if (!$this->dontSendEmail) {
            if ($this->identity === null) {
                $this->identity = auth()->user();
            }
            $this->identity->notify(new VerifyEmail());
        }
    }

    public function verifyMail(): void
    {
        $this->identity->email_verified_at = Carbon::now();
        $this->identity->save();
    }

    public function sendLinkToRegisterNewClient(array $data): void
    {

    }

    /** Tworzy rekord w tabeli users
     * @param array $data - dane klienta
     * @return ?User null jeśli błąd
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
     * @param array $data - dane warsztatu
     * @return ?Workshop null jeśli błąd
     * @throws Exception
     */
    public function saveWorkshop(array $data): ?Workshop
    {
            // Tworzenie warsztatu
            $workshop = new Workshop();
            $workshop->identity_id = $this->identity->id;
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
     * @param $data
     * @return bool
     */
    private function checkIfUserExists($data): bool
    {
        $identity = Identity::where('email', '=', $data['email'])->first();
        if ($identity)
        {
            $this->identity = $identity;
            if ($this->identity->email_verified_at !== null) {
                $this->dontSendEmail = true;
            }
            return true;
        }
        return false;
    }

    public function addTypesToSession(): static
    {
        Session::forget('account_type');
        if ($this->identity->workshop) {
            Session::push('account_type','workshop');
        }
        if ($this->identity->user) {
            Session::push('account_type','client');
        }
        if($this->identity->is_admin) {
            // jeśli admin to loguje na /admin, a tam może przelogować się na inny typ konta
            //@todo zrobić jedno konto warsztat i klient dla wszystkich adminów
            Session::forget('account_type');
            Session::push('account_type', 'admin');
            //@todo dodać do sesji random string i zrobić w db tabele admin_access, tam kolumny id:uuid:ip:datetime
        }

        return $this;
    }

    public function setIdentity(int $id): static
    {
        $this->identity = Identity::find($id);

        return $this;
    }

    public function getView(): string
    {
        if (Session::get('account_type')[0] === 'admin') {
            return view('admin.pages.dashboard');
        }
        if(count(Session::get('account_type')) > 1) {
            return view('changeType');
        }
        return Session::get('account_type')[0] . '.pages.dashboard';
    }

    public function getRoute(): string
    {
        if (Session::get('account_type')[0] === 'admin') {
            return route('admin.dashboard');
        }
        if(count(Session::get('account_type')) > 1) {
            return route('changeType');
        }
        return route(Session::get('account_type')[0] . '.dashboard', $this->identity->uuid);
    }

    public function getHomeRoute(): string
    {
        $this->identity = auth()->user();
        return $this->getRoute();
    }

    public function generateUuid(int $length = 10): string
    {
        while(true) {
            $uuid = Str::random($length);
            if (Identity::where('uuid', $uuid)->count() === 0) {
                return $uuid;
            }
        }
    }
}
