<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;
use App\Models\Like;

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
}
