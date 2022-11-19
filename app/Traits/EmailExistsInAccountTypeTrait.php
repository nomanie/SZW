<?php

namespace App\Traits;

use App\Enums\AccountTypeEnum;
use App\Models\Client;
use App\Models\User;
use App\Models\Workshop;

trait EmailExistsInAccountTypeTrait
{

    /** Sprawdza czy dany e-mail jest zarejestrowany jako dany typ konta
     * @param $email - adres e-mail
     * @return bool true jeśli rekord istnieje
     */
    public function checkIfEmailExistsInAccountType($email, $type): bool
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            if (AccountTypeEnum::CLIENT === $type) {
                if (Client::where('user_id', $user->id)->first()) {
                    return true;
                }
            } else if (AccountTypeEnum::WORKSHOP === $type) {
                if (Workshop::where('admin_id', $user->id)->first()) {
                    return true;
                }
            }
        }
        return false;
    }
}
