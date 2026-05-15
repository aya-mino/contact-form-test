@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<h1>Login</h1>
@if (session('status'))
<p>{{ session('status') }}</p>
@endif
<form class="auth-form" action="/login" method="post">
    @csrf

    <div>
        <p>メールアドレス</p>

        <input class="auth-form__input" type="email" name="email">
        @error('email')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p>パスワード</p>

        <input class="auth-form__input" type="password" name="password">
        @error('password')
        <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="auth-form__button">
    <button class="auth-form__button-submit" type="submit">
        ログイン
    </button>

</form>

@endsection