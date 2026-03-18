@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profiles.css') }}">
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
<div class="profile_form-content">
    <div class="form_group">
        <div class="form_group-content">
            <img src="{{ asset('storage/profiles/' . $profiles['image']) }}" alt="{{ $profiles['name'] }}">
            <h3>{{ $profiles['name'] }}</h3>
            <a href="{{ route('profile.edit', $profiles) }}">プロフィールを編集</a>
        </div>
    </div>
    @auth
    <div class="item_content-search">
        <a href="{{ route('profile.index', ['page' => 'sell']) }}" class="{{ $page === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="{{ route('profile.index', ['page' => 'buy']) }}" class="{{ $page === 'buy' ? 'active' : '' }}">購入した商品</a>
    </div>
    @endauth
    @if($page === 'sell')
    <div id="tab-sell" class="item_list">
        <div class="image-gallery">
            @foreach($items as $item)
            <div class="image-item">
                <div class="item-container">
                    <div class="item_image">
                        <img src="{{ asset('storage/items/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 250px; height: 250px; object-fit: cover;">
                    </div>
                    <div class="item_label">
                        <p>{{ $item['name'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div id="tab-buy" class="item_list">
        <div class="image-gallery">
            @foreach($items as $item)
            <div class="image-item">
                <div class="item-container">
                    <div class="item_image">
                        <img src="{{ asset('storage/items/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 250px; height: 250px; object-fit: cover;">
                    </div>
                    <div class="item_label">
                        <p>{{ $item['name'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection