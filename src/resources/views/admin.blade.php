@extends('layouts.app')

<style>
    svg.w-5.h-5 {
        width: 30px;
        height: 30px;
    }
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <form class="search-form" action="/search" method="post">
        @csrf
        <div class="search-form__item">

            <!-- 名前・メアド検索 -->
            <input class="search-form__item-input--text" type="text" name="search" placeholder="名前やメールアドレスを入力してください">

            <!-- 性別選択 -->
            <select class="search-form__item-select--gender" name="gender">
                <option value="" disabled selected hidden>性別</option>
                <option value="0">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>


            <!-- お問い合わせ種類選択 -->
            <select class="search-form__item-select--category" name="category_id">
                <option value="" disabled selected hidden>お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" >
                    {{ $category->content }}
                </option>
                @endforeach
            </select>

            <!-- 日付検索 -->
            <input class="search-form__item-input--date" type="date" name="date">

            <button class="search-form__item-button" type="submit">検索</button>
            <a href="/admin" class="search-form__item-button--reset">リセット</a>
        </div>
    </form>

    <!-- エクスポート -->
    <div class="content__middle">
        <div class="export">
            <a href="/admin">エクスポート</a>
        </div>
        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>



</div>

@endsection