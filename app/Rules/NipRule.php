<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NipRule implements Rule
{
    use RuleTrait;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = static::clean($value);
        if (!preg_match('/^[0-9]{10}$/', $value) || $value === '0000000000') {
            //check 10 digits
            return false;
        }
        $weights  = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $checkSum = static::getChecksum($value, $weights) % 10;
        if ($checkSum !== intval(substr($value, -1)) || $checkSum === 10) {
            return false;
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
        return __('Numer NIP jest niepoprawny.');
    }
}
