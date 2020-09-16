<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @param null $token
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $data                = $this->data;
        $data['headerTitle'] = 'パスワード再設定';
        $data['page_name']   = "static";
        $data['title']       = "会員様専用ページ";

        $params = $request->route()->parameters();
        if ($params['token'] == 'complete') {
            return view('auth.passwords.complete');
        }

        return view('auth.passwords.reset', $data)->with(['token' => $request->token, 'email' => $request->email]);
    }

    /**
     * @author : Phi .
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        $data                = $this->data;
        $data['headerTitle'] = 'パスワード再設定完了';
        $data['page_name']   = "static";
        $data['title']       = "パスワード再設定完了";

        return view('auth.passwords.reset_complete', $data)->with('status', trans($response));
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resetAdmin(Request $request)
    {
        $request->request->set('password_confirmation', $request->get('password'));

        return $this->reset($request);
    }
}
