@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" >
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
    <div class="profile_form-heading">
        <h1>プロフィール設定</h1>
    </div>
    <form class="form" action="{{ isset($profiles->id) ? route('profile.update', $profiles->id) : route('profile.store') }}" method="post" enctype='multipart/form-data'>
        @csrf
        @if(isset($profiles->id))
            @method('patch')
        @endif
        <div class="form_group">
            <div class="form_group-content">
                <div class="preview-img">
                    @if(isset($profiles->id))
                    <img src="{{ asset('storage/profiles/' . $profiles['image']) }}" alt="{{ $profiles['name'] }}" id="img">
                    @else
                    <img src="" alt=""  id="img">
                    @endif
                </div>
                <input type="file" id="input" name="image" accept="image/*">
                <input type="hidden" name="id" value="{{ $profiles['id']?? '' }}">
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
                    <input type="text" name="name" value="{{ old('name', $profiles['name'] ?? '') }}">
                    <input type="hidden" name="id" value="{{ $profiles['id'] ?? ''}}">
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
                    <input type="text" name="post" value="{{ old('post', $profiles['post'] ?? '') }}" size="8" maxlength="8">
                    <input type="hidden" name="id" value="{{ $profiles['id'] ?? ''}}">
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
                    <input type="text" name="address" value="{{ old('address', $profiles['address'] ?? '') }}">
                    <input type="hidden" name="id" value="{{ $profiles['id'] ?? ''}}">
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
                    <input type="text" name="building" value="{{ old('building', $profiles['building'] ?? '') }}">
                    <input type="hidden" name="id" value="{{ $profiles['id'] ?? ''}}">
                </div>
                <div class="form_error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_button">
            <button type="submit" class="form_button-submit">更新する</button>
        </div>
    </form>
</div>

<script>
    document.querySelector('#input').addEventListener('change', (event) => {
        const file = event.target.files[0]

        if (!file) return

        const reader = new FileReader()

        reader.onload = (event) => {
            document.querySelector('#img').src = event.target.result
        }

        reader.readAsDataURL(file)
    })
</script>
@endsection