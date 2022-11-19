<?php

namespace App\Rules;

use App\Enums\AccountTypeEnum;
use App\Models\Client;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\Rule;

class uniqueForAccountType implements InvokableRule
{
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function __invoke($attribute, $value, $fail)
    {//$value - email
        if(!AccountTypeEnum::getList($this->params)) {
            // jeśli typ konta jest błędny
            $fail('Błędny typ konta');
        }
        $user = User::where('email', $value)->first();
        if ($user) {
            if ($this->params === AccountTypeEnum::CLIENT) {
                if (Client::where('user_id', $user->id)->first()) {
                    $fail(__('Adres e-mail jest już zajęty dla tego typu konta.'));
                }
                return true;
            } else {
                if (Workshop::where('admin_id', $user->id)->first()) {
                    $fail(__('Adres e-mail jest już zajęty dla tego typu konta.'));
                }
                return true;
            }
        } else {
            return true;
        }
    }

    public function message()
    {
        // TODO: Implement message() method.
    }
}
