@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<h1>Register</h1>
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<form class="auth-form" action="/register" method="post">
    @csrf

    <div>
        <p>お名前</p>

        <input class="auth-form__input" type="text" name="name">

        @error('name')
        <p>{{ $message }}</p>
        @enderror
    </div>

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
    <div class=".auth-form__button">
    <button class="auth-form__button-submit" type="submit">
        登録
    </button>

</form>

@endsection