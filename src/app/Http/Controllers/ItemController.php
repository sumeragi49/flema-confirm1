<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;
use App\Models\Like;
use App\Models\Condition;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $tab = $request->query('tab', 'recommend');

        $items =Item::with('order')->get();

        $items = [];

        if ($tab === 'myList') {
            $likeItemIds = Like::where('user_id', Auth::id())->pluck('item_id')->toArray();

            $items = Item::whereIn('id', $likeItemIds)->get();
        }else {
            $items = Item::where('user_id', '!=', $userId)->get();
        }

        return view('index', compact('userId', 'items','tab'));
    }

    public function search()
    {

    }

    public function show($itemId)
    {
        $user = Auth::user();

        $items = Item::with(['condition', 'profile', 'likes', 'comments.profile'])->findOrFail($itemId);
        echo $items->comments_count;

        $isFavorite = false;

        if (Auth::check()) {

        }

        return view('detail', compact('isFavorite', 'items'));
    }

    public function sell(Request $request)
    {
        $user = Auth::user();

        $profiles = $user->profile;

        $items = Item::with('condition', 'categories')->get();

        $conditions = Condition::all();

        $categories = Category::all();

        return view('sell', compact('user', 'profiles', 'items', 'conditions', 'categories'));
    }

    public function sellStore(ExhibitionRequest $request)
    {
        $user = Auth::user();

        $profiles = $user->profile;

        $items = $request->only(['user_id','profile_id', 'condition_id', 'image', 'name', 'brand_name', 'content', 'price']);

        if(request('image')) {
            $file = request()->file('image')->getClientOriginalName();

            $name = date('Ymd_His').'_'. $file;

            request()->file('image')->move('storage/items/', $name);

            $items['image'] = $name;
        }

        Item::create($items);

        $items = Item::with('categories')->latest()->first();

        $items->categories()->sync($request->categories);

        return redirect('/dashboard');
    }
}
