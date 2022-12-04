<?php

namespace App\Rules;

use App\Enums\AccountTypeEnum;
use App\Models\System\Identity;
use App\Models\System\User;
use App\Models\Workers\Worker;
use App\Models\Workshop;
use Illuminate\Contracts\Validation\InvokableRule;

class OneAccountTypeForIdentity implements InvokableRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function __invoke($attribute, $value, $fail)
    {
        $identity = Identity::where('email', $value)->first();
        if ($identity) {
            if (AccountTypeEnum::CLIENT === $this->params) {
                if (User::where('identity_id', $identity->id)->first()) {
                    $fail(__('Konto o takim adresie e-mail już istnieje'));
                }
            } else if (AccountTypeEnum::WORKSHOP === $this->params) {
                if (Workshop::where('identity_id', $identity->id)->first()) {
                    $fail(__('Konto o takim adresie e-mail już istnieje'));
                }
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
