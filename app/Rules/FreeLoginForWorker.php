<?php

namespace App\Rules;

use App\Models\Workers\Worker;
use Illuminate\Contracts\Validation\InvokableRule;

class FreeLoginForWorker implements InvokableRule
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
        if (Worker::where('workshop_id', $this->params)->where('login', $value)->first())
        {
            $fail(__('Pracownik o takim loginie już istnieje'));
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
