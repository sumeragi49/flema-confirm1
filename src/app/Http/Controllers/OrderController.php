<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;


class OrderController extends Controller
{
    public function index(Request $request, $itemId)
    {
        $user = Auth::user();

        $profiles = $user->profile;

        $items = Item::findOrFail($itemId);

        return view('purchase', compact('user','profiles', 'items'));
    }

    public function store(PurchaseRequest $request, $itemId)
    {
        $user = Auth::user();

        $items = Item::findOrFail($itemId);

        $orders = $request->only(['user_id', 'item_id', 'payment_method', 'post', 'address', 'building']);

        Order::create($orders);

        return redirect()->away($items['stripe_url']);
    }
}
