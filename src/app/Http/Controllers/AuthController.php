<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Laravel\Fortify\Contracts\CreateNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(RegisterRequest $request): RegisterResponse
    {
        $user = $request->only(['name', 'email', 'password']);

        $password = $request->input('password');
        $user['password'] = Hash::make($password);

        User::create($user);

        $user = User::latest()->first();

        if ($user) {
            Auth::login($user);
        }

        return app(RegisterResponse::class);
    }

    public function login()
    {
        return view('auth.login');
    }
}
