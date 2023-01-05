<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EqualTo implements Rule
{
    public $targetValue;
    public $attribute;
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
        //dd($attribute);
        $this->attribute = $attribute;
        return $value == $this->targetValue;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  "The ".$this->attribute." must be equal to ".$this->targetValue;
    }
}
