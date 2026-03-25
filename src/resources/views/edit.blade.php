@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="profile_form-content">
    <div class="profile_form-heading">
        <h1>プロフィール設定</h1>
    </div>
    <form class="form" action="">
        <div class="form_group">
            <div class="form_group-content">
                <div class="form_input">
                    <input type="file" name="image" value="{{ $profiles['image'] }}" placeholder="画像を選択する">
                    <input type="hidden" name="id" value="{{ $profile['id'] }}">
                </div>
                <div class="form_error">
                    @error('image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label">ユーザー名</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="name" value="{{ $profiles['name'] }}">
                    <input type="hidden" name="id" value="{{ $profile['id'] }}">
                </div>
                <div class="form_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span class="form_label">郵便番号</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="post" value="{{ $profiles['post'] }}" size="8" maxlength="8" pattern="¥d{3}-¥d{4}">
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
                    <input type="hidden" name="id" value="{{ $profile['id'] }}">
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