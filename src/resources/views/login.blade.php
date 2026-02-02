@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <p>Login</p>
    </div>
    <form class="login-form" action="/login" method="post">
        @csrf

        <!-- メールアドレス入力 -->
        <div class="login-form__group">
            <div class="login-form__group--title">
                <span class="login-form__label--item">メールアドレス</span>
            </div>
            <div class="login-form__group--content">
                <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
            </div>
            <div class="login-form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- パスワード入力 -->
        <div class="login-form__group">
            <div class="login-form__group--title">
                <span class="login-form__label--item">パスワード</span>
            </div>
            <div class="login-form__group--content">
                <input type="password" name="password" placeholder="例：coachtech1106">
            </div>
            <div class="login-form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- ログイン -->
        <div class="login-form__button">
            <button type="submit" class="login-form__button--submit">ログイン</button>
        </div>
    </form>
</div>

@endsection