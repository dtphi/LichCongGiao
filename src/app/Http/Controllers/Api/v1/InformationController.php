<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Rules\ExistBase;
use App\Rules\ExistMember;
use App\Services\Contracts\InformationContract as IfSv;
use Auth;
use Illuminate\Http\Request;
use Validator;

class InformationController extends ApiController
{
    /**
     * @var IfSv|null
     */
    protected $ifSv = null;

    /**
     * @author : Phi .
     * InformationController constructor.
     * @param IfSv $ifSv
     */
    public function __construct(IfSv $ifSv)
    {
        $this->ifSv = $ifSv;
        parent::__construct();
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return array
     */
    public function getInformation(Request $request)
    {
        $formData = $request->all();
        $json     = $this->apiGetError();

        $formData['app']     = isset($formData['app']) ? $formData['app'] : '';
        $formData['user_id'] = isset($formData['user_id']) ? $formData['user_id'] : null;
        $formData['base_id'] = isset($formData['base_id']) ? $formData['base_id'] : null;

        try {
            if ($this->__getValidate($formData)) {
                $json = $this->ifSv->apiGetInformation($formData);
            }
        } catch (\Exception $e) {
            $json = $this->apiGetError();
        }

        return $json;
    }

    /**
     * @author : Phi .
     * @param array $formData
     * @return bool
     */
    private function __getValidate(&$formData = [])
    {
        $validator = Validator::make($formData, [
            'user_id' => ['required', new ExistMember()],
            'base_id' => ['required', new ExistBase()]
        ]);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
