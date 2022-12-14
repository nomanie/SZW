<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BankAccountRule implements Rule
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
        $checkedValue = static::clean($value);

        if (!preg_match('/^[0-9]{26}$/', $value)) {
            //check 11 digits
            return false;
        }
        $weights = [1, 10, 3, 30, 9, 90, 27, 76, 81, 34, 49, 5, 50, 15, 53, 45, 62, 38, 89, 17, 73, 51, 25, 56, 75, 71, 31, 19, 93, 57];
        $reverseNrb = strrev(substr($value, 2) . '2521' . substr($value, 0, 2));
        $checkSum = static::getChecksum($reverseNrb, $weights, 97);
        if ($checkSum !== 1) {
            return false;
        }

        //sprawdzamy jeszcze czy kod oddziału jest prawidłowy
        $bankDepartmentId = substr($checkedValue, 2, 8);
        $checkSum = static::getChecksum($bankDepartmentId, [3, 9, 7, 1, 3, 9, 7, 1], 10);
        if ($checkSum || $bankDepartmentId === '00000000') {
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
        return 'The validation error message.';
    }
}
