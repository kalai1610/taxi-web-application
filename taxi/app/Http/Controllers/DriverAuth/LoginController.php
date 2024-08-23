<?php

namespace App\Http\Controllers\DriverAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    protected $redirectTo = '/home';


    protected function guard()
    {
        return Auth::guard('driver');
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

    public function showLoginForm(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login')
            ->with([
                'user' => '_Driver',
                'register' => '/driver/register',
                'loginRoute' => 'driver/login'
            ]);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/driver/login');
    }
}
