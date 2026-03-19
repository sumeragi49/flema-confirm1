@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" >
@endsection

@section('nav')
<ul class="header-nav">
    <li class="header-nav_item">
        @auth
        <form class="search-form" action="{{ route('items.search') }}" method="get">
            @csrf
            <input type="hidden" name="tab" value="{{ $tab }}">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか？" onchange="this.form.submit()">
        </form>
        @else
        <form class="search-form" action="{{ route('items.search') }}" method="get">
            @csrf
            <input type="hidden" name="tab" value="{{ $tab }}">
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
            <a href="/profile/mypage">マイページ</a>
        </li>
        <li class="header-nav_sell">
            <a href="/sell">出品</a>
        </li>
    </nav>
</ul>
@endsection


@section('content')
<div class="item_content">
    <div class="item_content-search">
        @auth
        <a href="{{ route('item.index', ['tab' => 'recommend']) }}" class="{{ $tab === 'recommend' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('item.index', ['tab' => 'myList']) }}" class="{{ $tab === 'myList' ? 'active' : '' }}">マイリスト</a>
        @else
        <a href="{{ route('items.index', ['tab' => 'recommend']) }}" class="{{ $tab === 'recommend' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'myList']) }}" class="{{ $tab === 'myList' ? 'active' : '' }}">マイリスト</a>
        @endauth
    </div>
    <div class="item_list">
        <div class="image-gallery">
            @foreach($items as $item)
            <a href="/item/{{ $item['id'] }}">
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
        </div>
    </div>
</div>
@endsection