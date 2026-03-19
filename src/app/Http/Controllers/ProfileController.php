<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        return view('profile', compact('userId'));
    }

    public function store(Request $request)
    {
        $profiles['user_id'] = Auth::id();

        $profiles = $request->only(['image', 'name', 'post', 'address', 'building']);

        if(request('image')) {
            $name = request()->file('image')->getClientOriginalName();

            request()->file('image')->move('storage/items/', $name);

            $profiles['image'] = $name;
        }

        Profile::create($profiles);

        dd($profiles);

        return redirect('/dashboard');
    }
}
