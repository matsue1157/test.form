# test.form確認テスト＿お問合せフォーム
## 環境構築
# リポジトリをクローン
- git clone
- cd Contact.form
# dockerの設定
- docker-compose up -d --build
# phpコンテナのログイン
- docker-compose exec php bash
- composeer install
- npm install && npm run dev
# .envの設定
- cp .env.example .env
# keyの設定
- php artisan key:generate
# パッケージのインストール
- composer install
- npm install
- npm run dev
# データベースの設定
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
# 各マイグレーション
- php artisan make:migration create_contacts_table
- php artisan make:migration create_categories_table
- php artisan make:migration create_users_table
- php artisan make:migration create_items_table
# マイグレーションの実行
- php artisan migrate
# シーディング
- php artisan migrate:fresh --seed
##　 使用技能
- PHP version 7.4.9
- Laravel Framework 8.83.29
- Composer version 2.8.8
- mysql  Ver 15.1
- Docker version 28.0.1,
# 言語
- PHP（バックエンド）
- Blade（テンプレートエンジン）
- HTML / CSS（マークアップ、スタイリング）
- JavaScript（フロントエンド）
- MySQL (データベース)
- SQL (データ操作言語)
##　URL
- http://localhost./
- http://localhost/login
- http://localhost/register
- http://localhost/admin
- http://localhost/thanks
## 管理者ログイン
- admin@example.com
- password123
