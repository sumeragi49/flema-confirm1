@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="">
        <div class="item_container">
            <div class="container_left">
                <div class="container_left-item">
                    <img src="{{ asset('images/' . $items['image']) ) }}" alt="{{ $item['name'] }}">
                    <h1>{{ $item['name'] }}</h1>
                    <span>¥{{ $item['price'] }}</span>
                </div>
                <div class="container_left-item">
                    <div class="container_left-item_title">
                        <h2>支払い方法</h2>
                    </div>
                    <div class="container_left-item_content">
                        <select class="payment_method" name="payment_method">
                            <option value="" selected>選択してください</option>
                            <option value="1">コンビニ払い</option>
                            <option value="2">カード支払い</option>
                        </select>
                    </div>
                </div>
                <div class="container_left-item">
                    <div class="container_left-item_title">
                        <h2>配送先</h2>
                        <a href="">変更する</a>
                    </div>
                    <div class="container_left-item_content">
                        <h3>{{ $profiles['post'] }}</h3>
                        <h3>{{ $profiles['address'] }}</h3>
                        <h3>{{ $profiles['building'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="container_right">
                <div class="container_right-item">
                    <div class="top-box">
                        <span>商品代金</span>
                        <span>¥{{ $item['price'] }}</span>
                    </div>
                    @if($itemDate)
                    <div class="bottom-box">
                        <span>支払い方法</span>
                        <span>{{ $itemDate['payment_method'] }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>


<div class="sell_form-content">
    <form action="">
        <div class="form_container">
            <div class="form_group">
                <div class="form_group-title">
                    <h3>商品画像</h3>
                </div>
                <div class="form_group-content">
                    <input type="file" name="image" placeholder="画像を選択する">
                </div>
            </div>
        </div>
        <div class="form_container">
            <div class="form_container-title">
                <h2>商品の詳細</h2>
            </div>
            <div class="form_group">
                @foreach($items->categories as $category)
                <div class="form_group-title">
                    <h3>カテゴリー</h3>
                </div>
                <div class="form_group-content">
                    <input type="checkbox" name="category_id" value="category['id']">{{ $category['name'] }}
                </div>
                @endforeach
            </div>
            <div class="form_group">
                <div class="form_group-title">
                    <h3>商品の状態</h3>
                </div>
                <div class="form_group-content">
                    <select name="condition_id">
                        @foreach($items->conditions as $condition)
                        <option value="" >選択してください</option>
                        <option value="{{ $condition['id'] }}">{{ $condition['name'] }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form_container">
            <div class="form_container-title">
                <h2>商品名と説明</h2>
            </div>
            <div class="form_group">
                <div class="form_group-title">
                    <h3>商品名</h3>
                </div>
                <div class="form_group-content">
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form_group">
                <div class="form_group-title">
                    <h3>ブランド名</h3>
                </div>
                <div class="form_group-content">
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}">
                </div>
            </div>
            <div class="form_group">
                <div class="form_group-title">
                    <h3>販売価格</h3>
                </div>
                <div class="form_group-content">
                    <input type="text" name="price" value="{{ old('price') }}">
                </div>
            </div>
        </div>
        <div class="form_button">
            <button class="form_button-submit">出品する</button>
        </div>
    </form>
</div>