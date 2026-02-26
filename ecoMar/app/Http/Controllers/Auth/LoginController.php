<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Add a flash message after successful authentication.
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath())
            ->with('status', 'Sessão iniciada com sucesso.')
            ->with('status_type', 'success');
    }

    /**
     * Custom failed login response with flash message.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => [trans('auth.failed')]])
            ->with('status', 'Credenciais inválidas. Verifica o email e a palavra-passe.')
            ->with('status_type', 'error');
    }

    /**
     * Log the user out and flash a status message.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('status', 'Terminaste sessão com sucesso.')
            ->with('status_type', 'success');
    }
}
