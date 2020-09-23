<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 9/23/2020
 * Time: 9:06 AM
 */

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;

class LcgUserController
{
    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $json   = [
            'message' => '',
            'errors'  => '',
            'code'    => 200,
            'results'    => []
        ];
        $data[] = [
            'id'    => 1,
            'name'  => 'Admin',
            'email' => 'admin@gmail.com'
        ];

        $json['results'] = $data;

        return \response()->json($json);
    }
}
