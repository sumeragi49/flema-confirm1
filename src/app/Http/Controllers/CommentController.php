<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $user = Auth::user();

        $comments = $request->only(['user_id', 'profile_id', 'item_id', 'content']);

        Comment::create($comments);

        return redirect('/dashboard');
    }
}
