<?php

namespace App\Http\Controllers\DriverAuth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class  RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function guard()
    {
        return Auth::guard('driver');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'min:10', 'unique:drivers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:drivers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Driver::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function showRegistrationForm()
    {
        return view('auth.register')
            ->with([
                'user' => '_Driver',
                'login' => '/driver/login',
                'registerRoute' => '/driver/register'
            ]);
    }
}
