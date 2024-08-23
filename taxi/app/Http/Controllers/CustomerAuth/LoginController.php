<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login')->with(
            [
                'user' => '_Customer',
                'register' => '/customer/register',
                'loginRoute' => '/customer/login'
            ]
        );
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function username()
    {
        return 'phone_number';
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'numeric', 'min:10'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/customer/login');
    }
}
