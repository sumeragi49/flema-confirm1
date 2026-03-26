# <span style="color:blue">環境構築<span>

## <span style="color:orange">Dockerビルド</span><br>

・git clone git@github.com:sumeragi49/flema.git<br>
・docker-compose up -d --build<br>

## <span style="color:orange">Laravel環境構築</span><br>

・docker-compose exec php bash<br>
・composer install<br>
・cp .env.example.env<br>
・php artisan key:generate<br>
・php artisan migrate<br>
・php artisan db:seed<br>

## <span style="color:orange">開発環境</span><br>

・一覧ページ　http://localhost(未認証), http://localhost/dashboard(認証)<br>
・一覧ページ（マイリスト） http://localhost/tab=mylist<br>
・登録ページ　http://localhost/register<br>
・ログインページ　http://localhost/login<br>
・商品詳細ページ　http://localhost/item/{item*id}<br>
・商品購入ページ　http://localhost/purchase/{item_id}<br>
・住所変更ページ　http://localhost/purchase/address/{item_id}<br>
・商品出品ページ　http://localhost/sell<br>
・プロフィールページ　http://localhost/mypage<br>
・プロフィール編集ページ　http://localhost/profile<br>
・プロフィール画面*購入した商品一覧　http://localhost/mypage/page=buy<br>
・プロフィール画面\_出品した商品一覧　http://localhost/mypage/page=sell<br>

## <span style="color:orange">使用技術（実行環境）</span><br>

・Composer version 2.9.3<br>
・laravel/laravel v8.6.12<br>
・laravel/fortify v1.19.1<br>
・laravel-lang/lang 7.0.9<br>
・laravel/cashier v13.17.0<br>

## <span style="color:orange">連携外部サイト</span><br>

・stripe<br>

### <span style="color:orange">test ユーザー</span><br>

・id:1 name:test太郎 email:test1@example.com password:coachtech1001<br>
・id:2 name:test次郎 email:test2@example.com password:coachtech1002<br>

### <span style="color:orange">ER図</span><br>
<img width="1349" height="1444" alt="スクリーンショット 2026-03-19 054201" src="https://github.com/user-attachments/assets/995b1417-8f6e-4b89-a220-d9759c64685f" />
