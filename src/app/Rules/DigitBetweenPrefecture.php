<?php

namespace App\Rules;

use App\Commons\ConstantService;
use Illuminate\Contracts\Validation\Rule;

class DigitBetweenPrefecture implements Rule
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
        $prefecture = array_key_exists($value,ConstantService::PREFECTURE);

        if ($prefecture) return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '選択した県は存在しません';
    }
}
