@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" >
@endsection

@section('content')
<div class="item_content">
    <div class="split_item-image_container">
            <img src="{{ asset('images/' . $items['image']) }}" alt="{{ $item['name'] }}">
    </div>
    <div class="split_item-text_container">
        <form action="">
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
            <div class="container_item">
                <div class="form_button">
                    <button class="form_button-submit">購入手続きへ</button>
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
            <div class="container_item">
                @foreach($items->categories as $category)
                <h3>カテゴリー</h3>
                <input type="text" name="category_id" value="{{ $category['id'] }}">{{ $category['name'] }}
                @endforeach
            </div>
            <div class="container_item">
                <h3>商品の状態</h3>
                <p>{{ $items->conditions['name'] }}</p>
            </div>
        </form>
        <form action="">
            <div class="container_item">
                <h2>コメント</h2>
                <span>{{ $comments->count() }}</span>
            </div>
            <div class="container_item">
                <img src="{{ asset('images/' . $profiles['image']) }}" alt="{{ $profiles['name'] }}">
                <h3>{{ $profiles['name'] }}</h3>
            </div>
            <div class="container_item">
                @foreach($items->comments as $comment)
                <input type="text" name="comment_id" value="{{ $comments['content'] }}" placeholder="こちらにコメントが入ります。">
                @endforeach
            </div>
            <div class="container_item">
                <h3>商品へのコメント</h3>
                <textarea name="comment_content" value="{{ old('content') }}" ></textarea>
            </div>
            <div class="container_item">
                <div class="form_button">
                    <button class="form_button-submit">コメントを送信する</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
