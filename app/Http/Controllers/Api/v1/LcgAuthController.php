<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/23/2020
 * Time: 9:12 AM
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

class LcgAuthController
{
    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $json = [
            'message' => '',
            'errors'  => '',
            'code'    => 200,
            'results' => [
                'id'    => 1,
                'name'  => 'Admin',
                'email' => 'admin@gmail.com'
            ]
        ];

        return \response()->json($json);
    }
}
