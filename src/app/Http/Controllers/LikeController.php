<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, $itemId)
    {
        Like::firstOrCreate([
            'user_id' => Auth::id(),
            'item_id' => $itemId,
        ]);

        return redirect()->back();
    }

    public function unlike(Request $request, $itemId)
    {
        Like::where('user_id', Auth::id())->where('item_id', $itemId)->delete();

        return redirect()->back();
    }
}
