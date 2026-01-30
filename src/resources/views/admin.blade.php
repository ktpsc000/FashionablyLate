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
            <input class="search-form__item-input" type="text" name="search" placeholder="名前やメールアドレスを入力してください">
            <select class="search-form__item-select">
                <option value="name">名前</option>
                <option value="email">メールアドレス</option>
            </select>

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


            <button type="submit">Search</button>
        </div>
    </form>
</div>

@endsection