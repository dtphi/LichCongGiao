<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\ExistUserMail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        $data['headerTitle'] = 'パスワードを忘れた';

        return view('auth.passwords.email', $data);
    }

    /**
     * @author : Phi .
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRequestComplete()
    {
        $data['headerTitle'] = 'メール送信完了';

        return view('auth.passwords.email_complete', $data);
    }

    /**
     * @author : Phi .
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmailMember(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * @author : Phi .
     * @param Request $request
     */
    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'email' => 'max:255',
            'email' => 'email',
            'email' => new ExistUserMail()
        ]);
    }

    /**
     * @author : Phi .
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return redirect()->route('password.request.complete');
    }
}
