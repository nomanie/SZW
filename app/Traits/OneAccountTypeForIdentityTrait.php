<?php

namespace App\Traits;

use App\Enums\AccountTypeEnum;
use App\Models\System\Identity;
use App\Models\System\User;
use App\Models\System\Workshop;

trait OneAccountTypeForIdentityTrait
{
    /** Sprawdza czy identyfikacja posiada dany typ konta
     * @param $email - adres e-mail
     * @return bool true jeśli rekord istnieje
     */
    public function checkIfExists($email, $type): bool
    {
        $identity = Identity::where('email', $email)->first();
        if ($identity) {
            if (AccountTypeEnum::CLIENT === $type) {
                if (User::where('identity_id', $identity->id)->first()) {
                    return true;
                }
            } else if (AccountTypeEnum::WORKSHOP === $type) {
                if (Workshop::where('identity_id', $identity->id)->first()) {
                    return true;
                }
            }
        }
        return false;
    }
}
