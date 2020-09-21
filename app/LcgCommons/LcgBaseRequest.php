<?php
/**
 * Created by PhpStorm.
 * User: Phi
 * Date: 3/11/2020
 * Time: 2:37 PM
 */

namespace App\LcgCommons;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class LcgBaseRequest extends FormRequest
{
    /**
     * @var array
     */
    protected $formData = [];

    /**
     * @author : Phi .
     * @return mixed
     */
    public function getFormData()
    {
        return $this->formData;
    }

    /**
     * @author : Phi .
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
}
