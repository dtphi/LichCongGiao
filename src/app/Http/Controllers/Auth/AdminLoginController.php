<?php

namespace App\Http\Controllers\Auth;

use App\Commons\Service;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RedirectIfAdminAuthenticated;
use App\Rules\DigitBetweenOrganization;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends AdminController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @author : Phi .
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

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
     * Where to redirect users after login.
     * @return string
     */
    public function redirectTo()
    {
        return RedirectIfAdminAuthenticated::RedirectTo;
    }

    /**
     * @author : Phi .
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::guard(RedirectIfAdminAuthenticated::AdminGuard)->check()) {
            $data = $this->data;

            return view('admin.dashboard', $data);
        }

        $data['headerTitle'] = 'ログイン';

        return view('auth.admin.login', $data);
    }

    /**
     * @author : Phi .
     * [postLoginForm login process]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function loginAdmin(Request $request)
    {
        $request->request->set('organization_id', $request->get('organization_id'));
        $request->request->set('remember', $request->get('auto_login'));

        return $this->login($request);
    }

    /**
     * @author : Phi .
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        if (empty($request->get('password'))) {
            $request->validate([
                $this->username() => 'required|string',
                'organization_id' => ['required', new DigitBetweenOrganization()]
            ]);
        } else {
            $request->validate([
                $this->username() => 'required|string',
                'password'        => 'required|string',
                'organization_id' => ['required', new DigitBetweenOrganization()]
            ]);
        }
    }

    /**
     * @author : Phi .
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if (empty($request->get('password'))) {
            return $request->only($this->username(), 'organization_id');
        } else {
            return $request->only($this->username(), 'password', 'organization_id');
        }

    }

    /**
     * @author : Phi .
     * [loggedOut logout to member]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function loggedOut(Request $request)
    {
        $sv = new Service();
        $sv->adInsertLog('ログアウトしました。');

        return redirect(RedirectIfAdminAuthenticated::RedirectLogout);
    }
}
