<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
// write the function which will check if the login or logout if login then redirect to admin home otherwise redirect to login page if logout then redirects to the /login page

protected $redirectTo = '/admin/home';

/**
 * Handle post-login redirect.
 */
protected function authenticated(\Illuminate\Http\Request $request, $user)
{
    if (auth()->check()) {
        return redirect()->intended($this->redirectTo);
    }

    return redirect('/login');
}

/**
 * Log the user out and redirect to /login.
 */
public function logout(\Illuminate\Http\Request $request)
{
    $this->guard()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

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
}
