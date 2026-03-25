@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
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
<div class="address_form-content">
    <div class="address_form-heading">
        <h1>住所の変更</h1>
    </div>
    <form class="form" action="/purchase/address/{{$itemId}}/update" method="post">
        @method('patch')
        @csrf
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label">郵便番号</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="post" value="{{ $profiles['post'] }}">
                    <input type="hidden" name="id" value="{{ $profiles['id'] }}">
                </div>
                <div class="form_error">
                    @error('post')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label">住所</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="address" value="{{ $profiles['address'] }}">
                    <input type="hidden" name="id" value="{{ $profiles['id'] }}">
                </div>
                <div class="form_error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label">建物名</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="building" value="{{ $profiles['building'] }}">
                    <input type="hidden" name="id" value="{{ $profiles['id'] }}">
                </div>
                <div class="form_error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_button">
            <button class="form_button-submit">更新する</button>
        </div>
    </form>
</div>
@endsection