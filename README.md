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
・一覧ページ　http://localhost
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

<img width="1995" height="1469" alt="スクリーンショット 2026-01-31 080108" src="https://github.com/user-attachments/assets/a23c11d3-23bd-4bff-b7f9-fe3177cfe749" />


