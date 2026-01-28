@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
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
                    <input type="text" name="first_name" placeholder="例：山田" value="{{ $contact['first_name'] ?? old('first_name') }}">
                    <input type="text" name="last_name" placeholder="例：太郎" value="{{ $contact['last_name'] ?? old('last_name') }}">
                </div>
            </div>
            <div class="form__error">
                @php
                    $nameFields = ['first_name', 'last_name', 'name'];
                @endphp
                @foreach ($nameFields as $field)
                    @if ($errors->has($field))
                        {{ $errors->first($field) }}
                        @break
                    @endif
                @endforeach
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
            </div>
            <div class="form__error">
                @error('gender')
                {{ $message }}
                @enderror
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
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ $contact['email'] ?? old('email') }}">
                </div>
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
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
                    <input type="tel" name="tel1" placeholder="例：080" value="{{ $contact['tel1'] ?? old('tel1') }}">
                    <span class="form__tel-sep">-</span>
                    <input type="tel" name="tel2" placeholder="例：1234" value="{{ $contact['tel2'] ?? old('tel2') }}">
                    <span class="form__tel-sep">-</span>
                    <input type="tel" name="tel3" placeholder="例：5678" value="{{ $contact['tel3'] ?? old('tel3') }}">
                </div>
                <div class="form__error">
                    @php
                        $telFields = ['tel1', 'tel2', 'tel3', 'tel'];
                    @endphp
                    @foreach ($telFields as $field)
                        @if ($errors->has($field))
                            {{ $errors->first($field) }}
                            @break
                        @endif
                    @endforeach
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
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ $contact['address'] ?? old('address') }}">
                </div>
            </div>
            <div class="form__error">
                @error('address')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- 建物名入力 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ $contact['building'] ?? old('building') }}">
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
                        $selectedCategory = session('contact.categry_id', old('categry_id'));
                    @endphp
                    <select name="categry_id">
                        <option value="" disabled selected hidden>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form__error">
                @error('categry_id')
                {{ $message }}
                @enderror
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
            </div>
            <div class="form__error">
                @error('detail')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- 確認画面へ -->
        <div class="form__button">
            <button class="form__button--submit" type="submit">確認画面</button>
        </div>
    </form>
</div>

@endsection