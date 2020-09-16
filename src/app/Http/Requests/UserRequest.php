<?php

namespace App\Http\Requests;

use App\Commons\BaseRequest;

class UserRequest extends BaseRequest
{
    /**
     * @var array
     */
    protected $formData = [
        'email'             => null,
        'password'          => null,
        'name'              => null,
        'name_kana'         => null,
        'organization_id'   => null,
        'organization_code' => null,
        'type'              => null,
        'status'            => 0
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (parent::authorize()) {
            return true;
        }

        return true;
    }

    /**
     * @author : Phi .
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->formData = array_merge($this->formData, $this->all());

        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|string|max:255'
        ];
    }
}
