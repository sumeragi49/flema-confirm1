<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //登録メソッド
    public function register()
    {
        //auth.registerを呼び出す
        return view('auth.register');
    }

    //user登録メソッド（RegisterRequest使用）
    public function store(RegisterRequest $request)
    {   //変数usersは[name][email][password]を格納する
        $users = $request->only(['name', 'email', 'password']);
        //[name]は$usersの[name],[email]は$users[email],[password]は$users[password](Hashファサード使用)しUserモデルを元にデータを作成しDBに保存
        $users = User::create([
            'name' => $users['name'],
            'email' => $users['email'],
            'password' => Hash::make($users['password'])
        ]);
        //profile登録ページを表示
        return redirect('/email/verify');
    }
}
