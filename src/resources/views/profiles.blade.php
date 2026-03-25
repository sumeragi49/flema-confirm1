@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profiles.css') }}">
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav_item">
        @auth
        <form class="search-form" action="" method="get">
            @csrf
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか？" onchange="this.form.submit()">
        </form>
        @else
        <form class="search-form" action="{{ route('items.search') }}" method="get">
            @csrf
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
            <a href="/mypage/profile">マイページ</a>
        </li>
        <li class="header-nav_sell">
            <a href="/sell">出品</a>
        </li>
    </nav>
</ul>
@endsection


@section('content')
<div class="item_content">
    <div class="item_content-profile">
        <img src="{{ asset('storage/profiles/' . $profiles['image']) }}" alt="{{ $profiles['name'] }}">
        <h2>{{ $profiles['name'] }}</h2>
        <a href="/mypage/profile">プロフィールを編集</a>
    </div>
    <div class="item_content-search">
        <a href="{{ route('profile.index', ['page' => 'sell']) }}" class="{{ $page === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="{{ route('profile.index', ['page' => 'buy']) }}" class="{{ $page === 'buy' ? 'active' : '' }}">購入した商品</a>
    </div>
    <div class="item_list">
        <div class="image-gallery">
        @if($page === 'sell')
            @foreach($items as $item)
                <div class="image-item">
                    <a href="/item/{{ $item['id'] }}">
                        <div class="image-item_content">
                            <img src="{{ asset('storage/items/' . $item['image']) }}" alt="{{ $item['name'] }}">
                        </div>
                        <div class="item_label">
                            <p>{{ $item['name'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @elseif($page === 'buy')
            @foreach($items as $item)
                <div class="image-item">
                    <a href="/item/{{ $item['id'] }}">
                        <div class="image-item_content">
                            <img src="{{ asset('storage/items/' . $item->item['image']) }}" alt="{{ $item->item['name'] }}">
                        </div>
                        <div class="item_label">
                            <p>{{ $item->item['name'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
@endsection