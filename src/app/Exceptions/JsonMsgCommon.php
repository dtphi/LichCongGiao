<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class JsonMsgCommon extends Exception
{
    /**
     * @author : Phi .
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'code'    => Response::HTTP_BAD_REQUEST,
            'message' => '入力項目に誤りがあります',
            'result'  => []
        ], Response::HTTP_OK);
    }
}
