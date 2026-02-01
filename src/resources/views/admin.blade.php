@extends('layouts.app')



@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    <!-- 検査フォーム -->
    <form class="search-form" action="/search" method="get">
        <div class="search-form__item">

            <!-- 名前・メアド入力 -->
            <input class="search-form__item-input--text" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <!-- 性別選択 -->
            <select class="search-form__item-select--gender" name="gender">
                <option value="" disabled selected hidden {{ request('gender') === null ? 'selected' : '' }}>性別</option>
                <option value="" {{ request('gender') === '' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>



            <!-- お問い合わせ種類選択 -->
            <select class="search-form__item-select--category" name="category_id">
                <option value="" disabled selected hidden {{ request('category_id') === null ? 'selected' : '' }}>お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>

            <!-- 日付選択 -->
            <input class="search-form__item-input--date" type="date" name="created_at" value="{{ request('created_at') }}">

            <!-- 検索ボタン -->
            <button class="search-form__item-button" type="submit">検索</button>

            <!-- リセットボタン -->
            <a href="/reset" class="search-form__item-button--reset">リセット</a>
        </div>
    </form>

    <!-- エクスポート -->
    <div class="content__middle">
        <div class="export">
            <a href="{{ url('/export') }}?{{ request()->getQueryString() }}">エクスポート</a>
        </div>
        <div class="pagination">
            {{ $contacts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <!-- お問合せ内容テーブル -->
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                    <th class="contact-form__header"><span class="contact-form__header-span">お名前</span></th>
                    <th class="contact-form__header"><span class="contact-form__header-span">性別</span></th>
                    <th class="contact-form__header"><span class="contact-form__header-span">メールアドレス</span></th>
                    <th class="contact-form__header"><span class="contact-form__header-span">お問い合わせの種類</span></th>
            </tr>

            @foreach($contacts as $contact)
            <tr class="contact-table__row">

                <!-- お名前 -->
                <td class="contact-table__item">
                    <div class="contact-table__item-name">
                        {{ $contact->first_name . '　' . $contact->last_name}}
                    </div>
                </td>

                <!-- 性別 -->
                <td class="contact-table__item">
                    <div class="contact-table__item-gender">
                        {{ [1=>'男性',2=>'女性',3=>'その他'][$contact->gender]}}
                    </div>
                </td>

                <!-- メアド -->
                <td class="contact-table__item">
                    <div class="contact-table__item-email">
                        {{ $contact->email }}
                    </div>
                </td>

                <!-- お問合せの種類 -->
                <td class="contact-table__item">
                    <div class="contact-table__item-content">
                        {{ $contact->category->content}}
                    </div>
                </td>

                <!-- 詳細ボタン -->
                <td class="contact-table__item">
                    <div class="contact-table__item-modal">
                        <a class="detail-button" href="#modal-{{ $contact->id }}">詳細</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<!-- モーダル表示 -->
@foreach($contacts as $contact)
<div class="modal" id="modal-{{ $contact->id }}">
    <div class="modal__content">

        <div class="modal__close">
            <a href="#" class="modal__close-button">
                <span class="modal__close-icon">×</span>
            </a>
        </div>

        <table class="modal-table">
            <tr class="modal-table__row">
                <th class="modal-table__header">お名前</th>
                <td class="modal-table__data">{{ $contact->first_name . '　' . $contact->last_name }}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">性別</th>
                <td class="modal-table__data">{{ [1=>'男性',2=>'女性',3=>'その他'][$contact->gender]}}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">メールアドレス</th>
                <td class="modal-table__data">{{ $contact->email }}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">電話番号</th>
                <td class="modal-table__data">{{ $contact->tel }}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">住所</th>
                <td class="modal-table__data">{{ $contact->address }}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">建物名</th>
                <td class="modal-table__data">{{ $contact->building }}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">お問い合わせの種類</th>
                <td class="modal-table__data">{{ $contact->category->content}}</td>
            </tr>
            <tr class="modal-table__row">
                <th class="modal-table__header">お問合せ内容</th>
                <td class="modal-table__data">{{ $contact->detail }}</td>
            </tr>
        </table>

        <!-- 削除ボタン -->
        <form class="delete-form" action="/delete" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $contact->id }}">
            <button class="delete-form__button-submit" type="submit">削除</button>
        </form>

    </div>
</div>
@endforeach


@endsection