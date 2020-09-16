<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ZeroExamResult implements Rule
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
        $flag = true;

        if (is_array($value)) {
            foreach ($value as $item) {
                $item  = (int)$item;
                if (!$item) {
                    $flag = false;

                    break;
                }
            }
        } else {
            $flag = false;
        }

        return $flag;
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
