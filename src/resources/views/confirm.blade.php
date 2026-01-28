@extends('layouts.app')

@section('css')
<link href="{{ asset('css/confirm.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm__table">
            <table class="confirm-table__inner">

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__data">{{ $contact['first_name'] }} {{ $contact['last_name'] }}</td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__data">{{ $contact['gender'] }}</td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__data">{{ $contact['email'] }}</td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__data">{{ $contact['tel'] }}</td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__data">{{ $contact['address'] }}</td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__data">{{ $contact['building'] }}</td>
                </tr>

                <tr>
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__data">{{ $contact['categories'] }}</td>
                </tr>

                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__data">{{ $contact['detail'] }}</td>
                </tr>

            </table>

            <div class="form__button">
                <button type="submit" class="form__button--submit">送信</button>
                <button type="submit" formaction="/tanks/back" class="form__button--back">修正</button>
            </div>
        </div>
    </form>
</div>
@endsection