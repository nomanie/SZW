<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RegonRule implements Rule
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
        if ((preg_match('/^[0-9]{9}$/', $value) || preg_match('/^[0-9]{14}$/', $value)) && (!str_starts_with($value, '000000000'))) {
            if (strlen($value) === 9) {
                $weights = [8, 9, 2, 3, 4, 5, 6, 7]; //wagi stosowane dla REGONów 9-znakowych
            } else {
                //dla dlugich numerów sprawdzamy sumę kontrolną dla krótkiego
                static::passes(substr($value, 0, 9), true);
                $weights = [2, 4, 8, 5, 0, 9, 7, 3, 6, 1, 2, 4, 8]; //wagi stosowane dla REGONów 14-znakowych
            }
            $checkSum = static::getChecksum($value, $weights) % 10;

            if ($checkSum !== intval(substr($value, -1))) {
                //jezeli suma kontrolna nie jest rowna ostatniej cyfrze w numerze REGON to numerek jest błędny
                return false;
            }

            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Numer REGON jest niepoprawny.');
    }
}
