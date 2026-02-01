<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>


<body>
    <main>
        <div class="thanks__content">
            <p class="thanks__title">Thank you</p>
            <div class="thanks__content-main">
                <p class="thanks__text">お問い合わせありがとうございました</p>
                <input class="thanks__button" type="button" value="HOME" onclick="location.href='{{ url('/') }}'">
            </div>
        </div>
    </main>
</body>


</html>