<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinExamPassedNum implements Rule
{
    /**
     * @var int
     */
    public $questionNum = 1;

    /**
     * @author : Phi .
     * MinExamPassedNum constructor.
     * @param $qNum
     */
    public function __construct($qNum)
    {
        if ($qNum) {
            $this->questionNum = $qNum;
        }
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
        return $value <= $this->questionNum;
    }

    /**
     * @author : Phi .
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '入力項目に誤りがあります';
    }
}
