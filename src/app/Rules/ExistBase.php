<?php

namespace App\Rules;

use App\Models\Base;
use Illuminate\Contracts\Validation\Rule;

class ExistBase implements Rule
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
     * @author : Phi .
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $base = Base::find($value);

        if (is_null($base)) return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '入力項目に誤りがあります';
    }
}
