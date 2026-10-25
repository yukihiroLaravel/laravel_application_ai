# laravel_application_ai

Laravel応用講座で作るアプリ「YouTubeまとめ×コミュニケーション」のリポジトリです。

- Laravel 13 / PHP 8.4 / MySQL 8.4
- Dockerで動きます（パソコンにPHPを入れる必要はありません）

## 起動方法

Docker Desktopを起動してから、次のコマンドを打ちます。

```
git clone https://github.com/yukihiroLaravel/laravel_application_ai.git
cd laravel_application_ai
docker compose up -d
```

初回は準備（ライブラリのインストール、`.env` の作成）に数分かかります。

- アプリ：http://localhost:8080
- Adminer（データベースを見るツール）：http://localhost:8088
  - サーバ：`db` ／ ユーザ名：`laravel` ／ パスワード：`password` ／ データベース：`laravel`

## よく使うコマンド

```
docker compose exec app php artisan migrate     # テーブルを作る
docker compose exec app php artisan tinker      # PHPを試せる画面
docker compose logs app                         # 起動時のログを見る
docker compose stop                             # 停止
```

## ポート番号がぶつかるとき

`port is already allocated` と出たら、ほかのアプリ（MAMPや別のDocker環境）が同じポートを使っています。そのアプリを止めるか、ポート番号を変えて起動します。

```
APP_PORT=18080 ADMINER_PORT=18088 docker compose up -d
```

## 注意

このリポジトリは誰でも見られます。`.env`・APIキー・パスワードなどは絶対にコミットしないでください。
