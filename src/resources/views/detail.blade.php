@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" >
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav_item">
        @auth
        <form class="search-form" action="{{ route('items.search') }}" method="get">
            @csrf
            <input type="hidden" name="tab" value="">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか？" onchange="this.form.submit()">
        </form>
        @else
        <form class="search-form" action="{{ route('items.search') }}" method="get">
            @csrf
            <input type="hidden" name="tab" value="">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか？" onchange="this.form.submit()">
        </form>
        @endauth
    </li>
    <nav>
        @auth
        <li class="header-nav_item">
            <form action="/logout" method="post">
                @csrf
                <button class="header-nav_button">ログアウト</button>
            </form>
        </li>
        @else
        <li class="header-nav_item">
            <form action="/login" method="get">
                @csrf
                <button class="header-nav_button">ログイン</button>
            </form>
        </li>
        @endauth
        <li class="header-nav_mypage">
            <a href="/mypage">マイページ</a>
        </li>
        <li class="header-nav_sell">
            <a href="/sell">出品</a>
        </li>
    </nav>
</ul>
@endsection

@section('content')
<div class="item_content">
    <div class="split_item-image_container">
        <img src="{{ asset('storage/items/' . $items['image']) }}" alt="{{ $items['name'] }}">
    </div>
    <div class="split_item-text_container">
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
        <div class="container_item-button">
            <div class="container_item-like">
                @if($items->likedUsers->contains(Auth::id()))
                <form action="{{ route('unlike', $items['id']) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">
                        <img src="{{ asset('storage/images/ハートロゴ_ピンク.png') }}" alt="ハートロゴ_ピンク">
                    </button>
                </form>
                @else
                <form action="{{ route('like', $items['id']) }}" method="post">
                    @csrf
                    <button type="submit">
                        <img src="{{ asset('storage/images/ハートロゴ_デフォルト.png') }}" alt="ハートロゴ_デフォルト">
                    </button>
                </form>
                @endif
                <span>{{ $items->likes->count() }}</span>
            </div>
            <div class="container_item-comment">
                <span>
                    <img src="{{ asset('storage/images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                </span>
                <div class="container_item-comment_count">
                    <span>{{ $items->comments->count() }}</span>
                </div>
            </div>
        </div>
        <div class="container_item">
            <div class="form_button">
                <a href="/purchase/{{ $items['id'] }}" class="form_button-submit">購入手続きへ</a>
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
            <input type="text" name="category_id" value="{{ $category['name'] }}">
            @endforeach
        </div>
        <div class="container_item-condition">
            <h3>商品の状態</h3>
            <p>{{ $items->condition['name'] }}</p>
        </div>
        <form action="{{ route('comment.store') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            @auth
            <input type="hidden" name="profile_id" value="{{ auth()->user()->profile->id }}">
            @endauth
            <input type="hidden" name="item_id" value="{{ $items['id'] }}">
            <div class="container_item">
                <h2>コメント({{ $items->comments->count() }})</h2>
            </div>
            @foreach($items->comments as $comment)
            <div class="container_item-profile">
                <img src="{{ asset('storage/profiles/' . $comment['profile']['image']) }}" alt="{{ $comment['profile']['name'] }}">
                <h3>{{ $comment['profile']['name'] }}</h3>
            </div>
            <div class="container_item">
                <input type="text" name="comment_id" value="{{ $comment['content'] }}" placeholder="こちらにコメントが入ります。">
            </div>
            @endforeach
            <div class="container_item">
                <h3>商品へのコメント</h3>
                <textarea name="content" value="{{ old('content') }}" ></textarea>
                <div class="form_error">
                    @error('content')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="container_item">
                <div class="form_button">
                    <button class="form_button-submit" type="submit">コメントを送信する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
