@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="/purchase/{{$items['id']}}/store" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <input type="hidden" name="item_id" value="{{ $items['id'] }}">
        <div class="item_container">
            <div class="container_left">
                <div class="container_left-item">
                    <img src="{{ asset('storage/items/' . $items['image']) }}" alt="{{ $items['name'] }}">
                    <div class="container_left-item_text">
                        <h1>{{ $items['name'] }}</h1>
                        <span>¥{{ $items['price'] }}</span>
                    </div>
                </div>
                <div class="container_left-item">
                    <div class="container_left-item_title">
                        <h2>支払い方法</h2>
                    </div>
                    <div class="container_left-item_content">
                        <select class="payment_method" name="payment_method" id="payment_method">
                            <option value="" selected>選択してください</option>
                            <option value="コンビニ払い">コンビニ払い</option>
                            <option value="カード支払い">カード支払い</option>
                        </select>
                    </div>
                </div>
                <div class="container_left-item_title">
                    <h2>配送先</h2>
                    <a href="">変更</a>
                </div>
                <div class="container_left-item_content">
                    <div class="container_left-item_address">
                        <h3>{{ $profiles['post'] }}</h3>
                        <input type="hidden" name="post" value="{{ $profiles['post'] }}">
                        <h3>{{ $profiles['address'] }}</h3>
                        <input type="hidden" name="address" value="{{ $profiles['address'] }}">
                        <h3>{{ $profiles['building'] }}</h3>
                        <input type="hidden" name="building" value="{{ $profiles['building'] }}">
                    </div>
                </div>
            </div>
            <div class="container_right">
                <div class="container_right-item">
                    <div class="top-box">
                        <span>商品代金</span>
                        <span>¥{{ $items['price'] }}</span>
                    </div>
                    <div class="bottom-box">
                        <span>支払い方法</span>
                        <span id="selected-method"></span>
                    </div>
                </div>
                <div class="form_button">
                    <button class="form_button-submit" type="submit">購入する</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function() {
        const selectedText = this.options[this.selectedIndex].text;
        document.getElementById('selected-method').innerText = this.value ? selectedText : '';
    });
</script>
@endsection
