<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinBikou implements Rule
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
        return !isset($value) || (mb_strlen($value, 'utf8') >= 20) ? TRUE : FALSE ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.min_bikou');
    }
}
