# FashionablyLate

## 環境構築
- `git clone git@github.com:ktpsc000/FashionablyLate.git`
- `docker-compose up -d --build`

## Laravel環境構築
- `docker-compose exec php bash`
- `composer install`
- `cp .env.example .env` ,環境変数を適宜変更
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`

## 開発環境

| 機能 | URL |
|---|---|
| お問い合わせ | http://localhost/ |
| ユーザー登録 | http://localhost/register |
| phpMyAdmin | http://localhost:8080 |

## 使用技術(実行環境)
- PHP 8.1.34
- Laravel 8.83.29
- MySQL 8.0.26
- nginx 1.21.1

## ER図
![ER図](index.drawio.png)

