@extends('layouts.app')



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
            {{ $contacts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <!-- お問合せ内容テーブル -->
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-form__header">
                    <span class="contact-form__header-span">お名前</span>
                    <span class="contact-form__header-span">性別</span>
                    <span class="contact-form__header-span">メールアドレス</span>
                    <span class="contact-form__header-span">お問い合わせの種類</span>
                </th>
            </tr>

            @foreach($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">
                    <div class="contact-table__item-name">
                        {{ $contact->first_name }} {{$contact->last_name}}
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection