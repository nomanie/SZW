<?php

namespace App\Services\Auth;

use App\Enums\AccountTypeEnum;
use App\Models\System\User;
use App\Models\System\Identity;
use App\Models\Workshop;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegisterService
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
        if (!$this->checkIfUserExists($data)) {
            // Zapis podstawowego usera
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
     */
    public function saveUser(array $data): ?User
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->identity_id = $this->identity->id;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->phone = $data['phone'] ?? null;
            $user->date_of_birth = $data['date_of_birth'] ?? null;
            $user->city = $data['city'] ?? null;
            $user->street = $data['street'] ?? null;
            $user->zip_code = $data['zip_code'] ?? null;
            $user->building_number = $data['building_number'] ?? null;
            $user->flat_number = $data['flat_number'] ?? null;
            $user->avatar = $data['avatar'] ?? null;
            $user->consent_sms_notification = $data['consent_sms_notification'] ?? false;
            $user->consent_marketing_notification = $data['consent_marketing_notification'] ?? false;
            $user->save();

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
    }

    /** Tworzy rekord w tabeli workshops
     * @param array $data - dane warsztatu
     * @return ?Workshop null jeśli błąd
     * @throws Exception
     */
    public function saveWorkshop(array $data): ?Workshop
    {
            //Tworzenie subdomeny
            $this->identity->domains()->create(['domain' => 'Warsztat_' . $this->identity->id, 'tenant_id' => $this->identity->id]);
            Artisan::call('tenants:migrate', [
                '--tenants' => [$this->identity->id]
            ]);
            // Tworzenie warsztatu
            $workshop = new Workshop();
            $workshop->identity_id = $this->identity->id;
            $workshop->workshops = $data['workshops'] ?? null;
            $workshop->owners = $data['owners'] ?? null;
            $workshop->name = $data['name'];
            $workshop->logo = $data['logo'] ?? null;
            $workshop->nip = $data['nip'];
            $workshop->regon = $data['regon'];
            $workshop->company_created_at = $data['company_created_at'] ?? null;
            $workshop->website = $data['website'] ?? null;
            $workshop->social_media = $data['social_media'] ?? null;
            $workshop->additional_data = $data['additional_data'] ?? null;
            if (!$workshop->save()) {
                throw new Exception;
            }
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
        $i = 0;
        if ($this->identity->workshop) {
            Session::push('account_type','workshop');
            $i++;
        }
        if ($this->identity->user) {
            Session::push('account_type','user');
            $i++;
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
        if(count(Session::get('account_type')) > 1) {
            return view('changeType');
        }
        return Session::get('account_type')[0] . '.pages.dashboard';
    }

    public function getRoute(): string
    {
        if(count(Session::get('account_type')) > 1) {
            return route('changeType');
        }
        return route(Session::get('account_type')[0] . '.dashboard', $this->identity->id);
    }
}
