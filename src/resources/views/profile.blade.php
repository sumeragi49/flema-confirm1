@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" >
@endsection

@section('content')
<div class="profile_form-content">
    <div class="profile_form-heading">
        <h1>プロフィール設定</h1>
    </div>
    <form class="form" action="{{ $isNew ? route('profile.store') : route('profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(!$isNew)
            @method('patch')
        @endif
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div class="form_group">
            <div class="form_group-content">
                <img id="img" src="{{ asset('storage/profiles/' . $profiles['image'] ) }}" alt="{{ $profiles['name']  }}">
                <input type="file" name="image" id="input" value="{{ old('image') }}" placeholder="画像を選択する">
                <input type="hidden" name="id" value="{{ $profiles['id'] }}">
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
                    <input type="hidden" name="id" value="{{ $profiles['id'] }}">
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