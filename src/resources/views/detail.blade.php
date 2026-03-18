@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" >
@endsection

@section('nav')
<nav>
    <ul class="header-nav">
        <li class="header-nav_item">
            <form action="">
                <input class="search_form" type="text">
            </form>
        </li>
        <nav>
            @auth
            <li class="header-nav_item">
                <form class="form" action="/logout" method="post">
                    @csrf
                    <button class="header-nav_button">ログアウト</button>
                </form>
            </li>
            @else
            <li class="header-nav_item">
                <a class="header-nav_button" href="/login">ログイン</a>
            </li>
            @endauth
            <li class="header-nav_item">
                <a class="header-nav_button" href="/mypage">マイページ</a>
            </li>
            <li class="header-nav_item">
                <a class="header-nav_link" href="/sell">出品</a>
            </li>
        </nav>
    </ul>
</nav>
@endsection

@section('content')
<div class="item_content">
    <div class="split_item-image_container">
            <img src="{{ asset('storage/items/' . $items['image']) }}" alt="{{ $items['name'] }}">
    </div>
    <div class="split_item-text_container">
        <div class="detail_form" action="/login" method="get">
            <div class="container_item">
                <h1>{{ $items['name'] }}</h1>
            </div>
            <div class="container_item">
                <p>{{ $items['brand_name'] }}</p>
            </div>
            <div class="container_item">
                <span>¥</span>
                <span>{{ $items['price'] }}</span>
                <span>(税込)</span>
            </div>
            <div class="container_item">
                <div class="container_item-icon">
                @auth
                    @if(Auth::user()->isLikedBy($items->id))
                    <form action="{{ route('likes.destroy', $items) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">❤️</button>
                        <p>{{ $items->likes->count() }}</p>
                    </form>
                    @else
                    <form action="{{ route('likes.store', $items) }}" method="post">
                        @csrf
                        <button class="like-btn {{ $items->isLikedBy(auth()->user()) ? 'active' : '' }}" type="submit">❤ </button>
                        <p>{{ $items->likes->count() }}</p>
                    </form>
                    @endif
                    <div class="comment_count">
                        <button>💬</button>
                        <p>{{ $items['comments']->count() ?? 0; }}</p>
                    </div>
                @endauth

                @guest
                    <form action="">
                        <button type="submit">❤</button>
                        <p>{{ $items->likes->count() }}</p>
                    </form>
                    <div class="comment_count">
                        <button class="comment_count">💬</button>
                        <p>{{ $items['comments']->count() ?? 0; }}</p>
                    </div>
                @endguest
                </div>
            </div>
            <div class="container_item">
                <div class="form_button">
                    <a href="{{ route('items.purchase', $items) }}" class="form_button" wire:click.prevent="selectItem({{ $items->id }})">購入手続きへ</a>
                </div>
            </div>
            <div class="container_item">
                <h2>商品説明</h2>
            </div>
            <div class="container_item">
                <p>{{ $items['content'] }}</p>
            </div>
            <div class="container_item">
                <h2>商品の情報</h2>
            </div>
            <div class="container_item-category">
                <h3>カテゴリー</h3>
                @foreach($items->categories as $category)
                    <p>{{ $category['name'] }}</p>
                @endforeach
            </div>
            <div class="container_item">
                <h3>商品の状態</h3>
                <p>{{ $items['condition']['name'] }}</p>
            </div>
        </div>
        <form class="comment_form" action="{{ route('comments.store', $items->id) }}" method="post">
            @csrf
            <div class="container_item">
                <h2>コメント({{ $items['comments']->count() ?? 0; }})</h2>
            </div>
            @foreach($items->comments as $comment)
            <div class="container_icon">
                @empty($comment['profile']['image'])
                <div class="profile-icon default-icon">
                    <input type="text">
                </div>
                @else
                <img class="profile_icon" src="{{ asset('images/' . $comment['profile']['image']) }}" alt="{{ $comment['profile']['name'] }}">
                @endempty
            </div>
            <div class="container_item">
                @empty($comment['profile']['name'])
                <h3>admin</h3>
                @else
                <h3>{{ $comment['profile']['name'] }}</h3>
            </div>
            <div class="container_item">
                @endempty
                @empty($comment['content'])
                <input type="text" placeholder="こちらにコメントが入ります" readonly>
                @else
                <p>{{ $comment['content'] }}</p>
                @endempty
            </div>
            @endforeach
            <div class="container_item-comment">
                <h3>商品へのコメント</h3>
                <textarea name="content" value="{{ old('content') }}" ></textarea>
            </div>
            <div class="form_error">
                @error('content')
                {{ $message }}
                @enderror
            </div>
            <div class="container_item">
                <div class="form_button">
                    <button class="form_button-submit">コメントを送信する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
