<?php

namespace App\Services\Auth;

use App\Enums\AccountTypeEnum;
use App\Models\Client;
use App\Models\User;
use App\Models\Workshop;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;

class RegisterService
{
    private bool $dontSendEmail;

    public function __construct(
        protected User|Authenticatable $user = new User()
    )
    {
        //@todo dodać logi
    }

    /** Tworzy rekord w tabeli users
     * @param array $data - dane użytkownika
     * @param int $account_type - typ tworzonego konta
     * @return bool null jeśli błąd
     */
    public function save(array $data, int $account_type): ?User
    {
        DB::beginTransaction();
        try {
            if (!$this->checkIfUserExists($data)) {
                // Zapis podstawowego usera
                $this->user->email = $data['email'];
                $this->user->password = bcrypt($data['password']);
                $this->user->account_type = $account_type;
                $this->user->save();
            }
            // Zapis konta typu klient
            if ($account_type == AccountTypeEnum::CLIENT) {
                $this->saveClient($data);
            } else {
                // Zapis konta typu warsztat
                $this->saveWorkshop($data);
            }
            DB::commit();
            $this->sendVerificationEmail();
            return $this->user;
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
    }

    public function sendVerificationEmail(): void
    {
        if (!$this->dontSendEmail) {
            if ($this->user === null) {
                $this->user = auth()->user();
            }
            $this->user->notify(new VerifyEmail());
        }
    }

    public function verifyMail(): void
    {
        $this->user->email_verified_at = Carbon::now();
        $this->user->save();
    }

    public function sendLinkToRegisterNewClient(array $data): void
    {

    }

    /** Tworzy rekord w tabeli clients
     * @param array $data - dane klienta
     * @return ?Client null jeśli błąd
     */
    public function saveClient(array $data): ?Client
    {
        DB::beginTransaction();
//        try {
            $client = new Client();
            $client->user_id = $this->user->id;
            $client->first_name = $data['first_name'];
            $client->last_name = $data['last_name'];
            $client->phone = $data['phone'] ?? null;
            $client->date_of_birth = $data['date_of_birth'] ?? null;
            $client->city = $data['city'] ?? null;
            $client->street = $data['street'] ?? null;
            $client->zip_code = $data['zip_code'] ?? null;
            $client->building_number = $data['building_number'] ?? null;
            $client->flat_number = $data['flat_number'] ?? null;
            $client->avatar = $data['avatar'] ?? null;
            $client->consent_sms_notification = $data['consent_sms_notification'] ?? false;
            $client->consent_marketing_notification = $data['consent_marketing_notification'] ?? false;
            $client->save();

            $this->loginUser();

            DB::commit();
            return $client;
//        } catch (\Exception $e) {
//            DB::rollback();
//            return null;
//        }
    }

    /** Tworzy rekord w tabeli workshops
     * @param array $data - dane warsztatu
     * @return ?Workshop null jeśli błąd
     */
    public function saveWorkshop(array $data): ?Workshop
    {
        DB::beginTransaction();
        try {
            $workshop = new Workshop();
            $workshop->admin_id = $this->user->id;
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
            $workshop->save();

            $this->loginUser();

            DB::commit();
            return $workshop;
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
    }

    /** Sprawdza czy użytkownik o podanym mailu istnieje już w bazie
     * @param $data
     * @return bool
     */
    private function checkIfUserExists($data): bool
    {
        $user = User::where('email', '=', $data['email'])->first();
        if ($user)
        {
            $this->user = $user;
            if ($this->user->email_verified_at !== null) {
                $this->dontSendEmail = true;
            }
            return true;
        }
        return false;
    }

    public function loginUser(): void
    {
        //tu jest błąd
        auth()->attempt($this->user->toArray());
    }
}
