@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register__heading">
        <h2>Register</h2>
    </div>
    <form class="create-form" action="/register" method="post">
        @csrf

        <!-- お名前入力 -->
        <div class="create-form__group">
            <div class="create-form__group--title">
                <span class="create-form__label--item">お名前</span>
            </div>
            <div class="create-form__group--content">
                <input type="text" name="name" placeholder="例：山田 太郎" value="{{ old('name') }}">
            </div>
            <div class="create-form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- メールアドレス入力 -->
        <div class="create-form__group">
            <div class="create-form__group--title">
                <span class="create-form__label--item">メールアドレス</span>
            </div>
            <div class="create-form__group--content">
                <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
            </div>
            <div class="create-form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- パスワード入力 -->
        <div class="create-form__group">
            <div class="create-form__group--title">
                <span class="create-form__label--item">パスワード</span>
            </div>
            <div class="create-form__group--content">
                <input type="password" name="password" placeholder="例：coachtech1106">
            </div>
            <div class="create-form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- 登録 -->
        <div class="create-form__button">
            <button type="submit" class="create-form__button--submit">登録</button>
        </div>
    </form>
</div>

@endsection