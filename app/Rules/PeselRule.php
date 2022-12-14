<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PeselRule implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match('/^[0-9]{11}$/', $value) || $value === '00000000000') {
            //check 11 digits
            return false;
        }
        $weights = [9, 7, 3, 1, 9, 7, 3, 1, 9, 7]; // weights
        $checkSum = static::getChecksum($value, $weights, 10);
        if ($checkSum !== intval(substr($value, -1))) {
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
        return __('Numer pesel jest niepoprawny.');
    }
}
