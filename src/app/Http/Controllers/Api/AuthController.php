<?php

namespace App\Http\Controllers\Api;

use App\Commons\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class AuthController extends ApiController
{
    /**
     * @var string
     */
    private $msgError = 'メールアドレスかパスワードが間違っています。';

    /**
     * AuthController constructor.
     */
    public function __construct()
    {}

    /**
     * @author : Phi .
     * @return string
     */
    public function logAuthenticate()
    {
        $sv         = new Service();
        $rName      = \request()->route()->getName();
        $actionText = 'ログインしました。';

        if ($rName == 'logout') {
            $actionText = 'ログアウトしました。';
        }
        $sv->adInsertLog($actionText);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email'    => $request->get('email'),
            'password' => $request->get('password')
        ];
        $validator   = Validator::make(array_merge($credentials, [
            'app' => $request->get('app'),
            'app_name' => $this->appName
        ]), [
            'app'      => 'required|string|same:app_name',
            'email'    => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($this->apiGetError($this->msgError), Response::HTTP_OK);
        }

        if (Auth::attempt($credentials)) {
            $user             = Auth::user();
            $success['token'] = $user->createToken($request->get('app'), [$this->appName])->accessToken;

            return response()->json([
                'code'    => 0,
                'message' => '',
                'result'  => $success
            ], Response::HTTP_OK);
        } else {
            return response()->json($this->apiGetError($this->msgError), Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request)
    {
        if (! $this->is121round($request)) {
            return response()->json($this->apiGetError(), Response::HTTP_OK);
        }

        return response()->json([
            'code'    => 0,
            'message' => '',
            'result'  => Auth::user()->getJson()
        ], Response::HTTP_OK);
    }
}
