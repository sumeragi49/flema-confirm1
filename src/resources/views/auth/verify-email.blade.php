@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}" >
@endsection

@section('content')
<div class="email_container">
    <p>登録していただいたメールアドレスに認証メールを送付しました。<br>メール認証を完了してください</p>
    <div class="verify-button">
        <a href="http://localhost:8025/#">認証はこちらから</a>
    </div>
    <div class="re-verify-button">
        <a href="/email/verify">認証メールを再送する</a>
    </div>
</div>
@endsection