<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $profiles = Auth::user()->profile ?? new Profile();
        $isNew = !Auth::user()->profile;

        return view('profile', compact('user', 'profiles','isNew'));
    }

    public function store(Request $request)
    {
        $profiles['user_id'] = Auth::id();

        $profiles = $request->only(['user_id', 'image', 'name', 'post', 'address', 'building']);

        if(request('image')) {
            $file = request()->file('image')->getClientOriginalName();

            $name = date('Ymd_His').'_'. $file;

            request()->file('image')->move('storage/profiles/', $name);

            $profiles['image'] = $name;
        }

        Profile::create($profiles);

        return redirect('/dashboard');
    }

    public function update(ProfileRequest $request)
    {
        $profiles = $request->only(['image', 'name', 'post', 'address', 'building']);

        Profile::find($request->id)->update($profiles);

        return redirect('/mypage');
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();

        $profiles = $user->profile;

        $page = $request->query('page', 'sell');

        $items = [];

        if ($page === 'buy') {

            $items = $user->orders()->with('item')->get();

        } else {

            $items = $user->items()->get();

        }

        return view('profiles', compact('user', 'items', 'profiles', 'page'));
    }

    public function address(Request $request, $itemId)
    {
        $user = Auth::user();

        $profiles = $user->profile;

        return view('address', compact('user', 'profiles', 'itemId'));
    }

    public function addressUpdate(AddressRequest $request, $itemId)
    {
        $profiles = $request->only(['post', 'address', 'building']);

        Profile::find($request->id)->update($profiles);

        return redirect()->route('purchase.index', ['itemId' => $itemId]);
    }
}
