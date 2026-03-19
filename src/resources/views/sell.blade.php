@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}" >
@endsection

@section('content')
<div class="sell_form-content">
    <div class="sell_form-heading">
        <h1>商品の出品</h1>
    </div>
    <form class="form" action="">
        <div class="form_container">
            <div class="form_group">
                <div class="form_group-title">
                    <h3>商品画像</h3>
                </div>
                <div class="form_group-content">
                    <input type="file" name="image" placeholder="画像を選択する">
                </div>
                <div class="form_error">
                    @error('image')
                    {{ $message }}
                    @enderror
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
                <div class="form_error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
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
                        @endforeach
                    </select>
                </div>
                <div class="form_error">
                    @error('condition_id')
                    {{ $message }}
                    @enderror
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
                <div class="form_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form_group">
                <div class="form_group-title">
                    <h3>ブランド名</h3>
                </div>
                <div class="form_group-content">
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}">
                </div>
                <div class="form_error">
                    @error('brand_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form_grope">
                <div class="form_group-title">
                    <h3>商品の説明</h3>
                </div>
                <div class="form_group-content">
                    <textarea name="content"></textarea>
                </div>
            </div>
            <div class="form_group">
                <div class="form_group-title">
                    <h3>販売価格</h3>
                </div>
                <div class="form_group-content">
                    <input type="text" name="price" value="{{ old('price') }}">
                </div>
                <div class="form_error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
            </div>
        </div>
        <div class="form_button">
            <button class="form_button-submit">出品する</button>
        </div>
    </form>
</div>
@endsection