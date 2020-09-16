<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Member;

class ExistUserMail implements Rule
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
        $member = Member::where(['email' => $value])->get();

        return ($member->count() > 0);
    }

    /**
     * @author : Phi .
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'メールアドレスに一致するユーザーが存在しません。';
    }
}
