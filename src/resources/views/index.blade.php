@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" >
@endsection

@section('nav')
<nav>
    <ul class="header-nav">
        <li class="header-nav_item">
            @auth
            <form class="search-form" action="{{ route('items.search') }}" method="get">
                @csrf
                <input type="hidden" name="tab" value="{{ $tab }}">
                <input class="search-form_item-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか？" onchange="this.form.submit()">
            </form>
            @else
            <form class="search-form" action="{{ route('item.search') }}" method="get">
                @csrf
                <input type="hidden" name="tab" value="{{ $tab }}">
                <input class="search-form_item-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="何をお探しですか？" onchange="this.form.submit()">
            </form>
            @endauth
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
    @auth
    <div class="item_content-search">
        <a href="{{ route('items.index', ['tab' => 'recommend', 'keyword' => request('keyword')]) }}" class="{{ $tab === 'recommend' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('items.index', ['tab' => 'myList', 'keyword' => request('keyword')]) }}" class="{{ $tab === 'myList' ? 'active' : '' }}">マイリスト</a>
    </div>
    @endauth

    @guest
    <div class="item_content-search">
        <a href="{{ route('item.index', ['tab' => 'recommend', 'keyword' => request('keyword')]) }}" class="{{ $tab === 'recommend' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ route('item.index', ['tab' => 'myList', 'keyword' => request('keyword')]) }}" class="{{ $tab === 'myList' ? 'active' : '' }}">マイリスト</a>
    </div>
    @endguest
    <div id="tab-recommended" class="item_list">
        <div class="image-gallery">
            @foreach($items as $item)
            <div class="image-item">
                <a href="/item/{{ $item['id'] }}">
                    <div class="item_image">
                        <img src="{{ asset('storage/items/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 250px; height: 250px; object-fit: cover;">
                    </div>
                    <div class="item_label">
                        <p>{{ $item['name'] }}</p>
                    </div>
                    @if($item->order)
                    <div class="sold-label">
                        <div class="sold-text">Sold</div>
                    </div>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

{{ $items->appends(['keyword' => request('keyword'), 'tab' => request('tab')])->links() }}