<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $users = $request->only(['name', 'email', 'password']);

        $password = $request->input('password');
        $users['password'] = Hash::make($password);

        User::create($users);

        return redirect('/profile');
    }

    public function login()
    {
        return view('auth.login');
    }
}
