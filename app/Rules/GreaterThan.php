<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GreaterThan implements Rule
{
    public $targetValue;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($targetValue)
    {
        $this->targetValue = $targetValue;
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
        dd($targetValue);
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
