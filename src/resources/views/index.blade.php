@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <p>Contact</p>
    </div>

    <!-- 入力フォーム -->
    <form class="form" action="/confirm" method="post">
        @csrf
        <!-- お名前入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input class="form__input--text-name" type="text" name="first_name" placeholder="例：山田" value="{{ $contact['first_name'] ?? old('first_name') }}">
                    <input class="form__input--text-name" type="text" name="last_name" placeholder="例：太郎" value="{{ $contact['last_name'] ?? old('last_name') }}">
                </div>
                <div class="form__error , form__error-name" >
                    @error('first_name')
                    <span>{{ $message }}</span>
                    @enderror
                    @error('last_name')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 性別入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    @php
                    $gender = session('contact.gender', old('gender'));
                    @endphp
                    <label>
                        <input type="radio" name="gender" value="1" {{ $gender == 1 ? 'checked' : '' }}>男性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="2" {{ $gender == 2 ? 'checked' : '' }}>女性
                    </label>
                    <label>
                        <input type="radio" name="gender" value="3" {{ $gender == 3 ? 'checked' : '' }}>その他
                    </label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <!-- メールアドレス入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--email">
                    <input type="text" name="email" placeholder="例：test@example.com" value="{{ $contact['email'] ?? old('email') }}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <!-- 電話番号入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tel1" placeholder="080" value="{{ $contact['tel1'] ?? old('tel1') }}">
                    <span class="form__tel-sep">-</span>
                    <input type="tel" name="tel2" placeholder="1234" value="{{ $contact['tel2'] ?? old('tel2') }}">
                    <span class="form__tel-sep">-</span>
                    <input type="tel" name="tel3" placeholder="5678" value="{{ $contact['tel3'] ?? old('tel3') }}">
                </div>
                <div class="form__error , form__error-tel">
                    @error('tel1')
                    <span>{{ $message }}</span>
                    @enderror
                    @error('tel2')
                    <span>{{ $message }}</span>
                    @enderror
                    @error('tel3')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 住所入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input class="form__input--text-address" type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ $contact['address'] ?? old('address') }}">
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <!-- 建物名入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input class="form__input--text-building" type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ $contact['building'] ?? old('building') }}">
                </div>
            </div>
        </div>

        <!-- お問い合わせの種類選択 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    @php
                    $selectedCategory = session('contact.category_id', old('category_id'));
                    @endphp
                    <select name="category_id">
                        <option value="" disabled selected hidden>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <!-- お問合せ内容入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ $contact['detail'] ?? old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <!-- 確認画面へ -->
        <div class="form__button">
            <button class="form__button--submit" type="submit">確認画面</button>
        </div>
    </form>
</div>

@endsection