<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //いいね機能のメソッド
    public function store(Request $request, $itemId)
    {
        //'user_id'（認証している）を検索し、なければデータを登録（'user_id', 'item_id'）item_idは選択した商品のid
        Like::firstOrCreate([
            'user_id' => Auth::id(),
            'item_id' => $itemId,
        ]);
        //route('items.show')にリダイレクトする
        return redirect()->route('items.show', $itemId);
    }
    //いいね解除メソッド
    public function destroy(Request $request, $itemId)
    {
        //user_id（認証ユーザーのもの）とitem_id(選択したitemのもの）の両方が登録されているときそのデータを削除
        Like::where('user_id', Auth::id())->where('item_id', $itemId)->delete();
        //route('items.show')にリダイレクトする
        return redirect()->route('items.show', $itemId);
    }
}
