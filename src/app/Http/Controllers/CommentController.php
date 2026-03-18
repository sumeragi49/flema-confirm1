<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //コメント登録メッソド（CommentRequestをバリデーションに使用）
    public function store(CommentRequest $request, $itemId)
    {
        //変数commentsはviewから呼び出した[user_id][item_id][profile_id][content]を格納する
        $comments = $request->only(['user_id', 'item_id', 'profile_id', 'content']);
        //変数commentsの[item_id]は選択した商品のidとする。
        $comments['item_id'] = $itemId;
        //変数commentsの[user_id]は認証ユーザーのuser_idとする
        $comments['user_id'] = Auth::id();
        //変数commentsの[profile_id]は認証ユーザーのuser_idに紐づいたprofile_id
        $comments['profile_id'] = auth()->user()->profile->id ?? null;
        //Commentモデルを元に$commentsを作成する
        Comment::create($comments);
        //route('items.show')にリダイレクトする。
        return redirect()->route('items.show', $itemId);
    }
}
