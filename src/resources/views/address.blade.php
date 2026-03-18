@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
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
<div class="address_form-content">
    <div class="address_form-heading">
        <h1>住所の変更</h1>
    </div>
    <form class="form" action="{{ route('address.update', ['itemId' => $items->id]) }}" method="post">
        @method('patch')
        @csrf
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label">郵便番号</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="post" value="{{ $profiles['post'] }}" size="8" maxlength="8">
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