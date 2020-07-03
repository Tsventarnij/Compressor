<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Decompress implements Rule
{
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
        return preg_match('/^[a-fA-F][a-fA-F0-9]+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The input string must contain only the following characters (a,b,c,d,e,f) and numbers';
    }
}
