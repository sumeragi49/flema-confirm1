@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
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
<div class="container">
    <form action="{{ route('items.buy', $items->id) }}" method="post" id="payment-form">
        @csrf
        <div class="item_container">
            <div class="container_left">
                <div class="container_left-item-top">
                    <img src="{{ asset('storage/items/' . $items['image']) }}" alt="{{ $items['name'] }}">
                    <div class="container_left-item_comment">
                        <h1>{{ $items['name'] }}</h1>
                        <span>¥{{ $items['price'] }}</span>
                    </div>
                </div>
                <div class="container_left-item">
                    <div class="container_left-area">
                        <div class="container_left-item_title">
                            <label>支払い方法</label>
                        </div>
                        <div class="container_left-item_content">
                            <select id="paymentMethod" name="payment_method">
                                <option value="">選択してください</option>
                                <option value="コンビニ払い" >コンビニ払い</option>
                                <option value="カード支払い" >カード支払い</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container_left-item">
                    <div class="container_left-area">
                        <div class="container_left-item_title">
                            <h2>配送先</h2>
                            <a href="{{ route('address.edit', $items->id) }}">変更する</a>
                        </div >
                        <div class="container_left-item_content">
                            <div class="container_left-item_content-bottom">
                                <h3>〒{{ $profiles['post'] }}</h3>
                                <h3>{{ $profiles['address'] }}</h3>
                                <h3>{{ $profiles['building'] }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="form_error">
                        @error('post')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form_error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="container_right">
                <div class="container_right-item">
                    <div class="container_right-item_content">
                        <div class="top-box">
                            <span>商品代金</span>
                            <span>¥{{ $items['price'] }}</span>
                        </div>
                        <div class="under-box">
                            <span>支払い方法</span>
                            <span id="display_paymentMethod">--</span>
                        </div>
                    </div>
                </div>
                <div class="form_error">
                    @error('payment_method')
                    {{ $message }}
                    @enderror
                </div>
                <div class="container_right-item">
                    <div class="form_button">
                        <button type="submit" class="form_button-submit">
                            購入する
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentSelect = document.getElementById('paymentMethod');
        const displayArea = document.getElementById('display_paymentMethod');

        paymentSelect.addEventListener('change', function() {
            const selectedText = paymentSelect.options[paymentSelect.selectedIndex].text;

            if(paymentSelect.value === "") {
                displayArea.textContent = "--";
            } else {
                displayArea.textContent = selectedText;
            }
        });
    });
</script>
@endsection