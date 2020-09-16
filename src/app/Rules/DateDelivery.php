<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateDelivery implements Rule
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
        $startTimestamp = strtotime($value);
        $endTimestamp = get_date_time_stamp();

        if ($startTimestamp < $endTimestamp) {
            return false;
        }

        return true;
    }

    /**
     * @author : Phi .
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '日付は今日以降を入力してください';
    }
}
