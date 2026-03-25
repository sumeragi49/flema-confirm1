環境構築

Dockerビルド
・git clone git@github.com:sumeragi49/flema.git
・docker-compose up -d --build

Laravel環境構築
・docker-compose exec php bash
・composer install
・cp .env.example.env
・php artisan key:generate
・php artisan migrate
・php artisan db:seed

開発環境
・一覧ページ　http://localhost(未認証), http://localhost/dashboard(認証)
・一覧ページ（マイリスト） http://localhost/tab=mylist
・登録ページ　http://localhost/register
・ログインページ　http://localhost/login
・商品詳細ページ　http://localhost/item/{item_id}
・商品購入ページ　http://localhost/purchase/{item_id}
・住所変更ページ　http://localhost/purchase/address/{item_id}
・商品出品ページ　http://localhost/sell
・プロフィールページ　http://localhost/mypage
・プロフィール編集ページ　http://localhost/profile
・プロフィール画面_購入した商品一覧　http://localhost/mypage/page=buy
・プロフィール画面_出品した商品一覧　http://localhost/mypage/page=sell

使用技術（実行環境）
・Composer version 2.9.3
・laravel/laravel v8.6.12
・laravel/fortify v1.19.1
・laravel-lang/lang 7.0.9
・laravel/cashier v13.17.0

連携外部サイト
・stripe

test ユーザー
・id:1 name:test太郎 email:test1@example.com password:coachtech1001
・id:2 name:test次郎 email:test2@example.com password:coachtech1002

<img width="1349" height="1444" alt="スクリーンショット 2026-03-19 054201" src="https://github.com/user-attachments/assets/995b1417-8f6e-4b89-a220-d9759c64685f" />



