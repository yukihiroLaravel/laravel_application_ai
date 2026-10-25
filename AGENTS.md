# このリポジトリについて（AIアシスタント向けのルール）

このリポジトリは「Laravel応用講座」の教材用アプリ（YouTubeまとめ×コミュニケーション）です。
使っているのは、PHPの基礎を学んだばかりの初心者の受講生です。

## 環境

- Laravel 13 / PHP 8.4。PHP・Composer・MySQLはすべてDockerのコンテナの中で動いています
- **パソコン本体にPHPやComposerをインストールしないでください**
- コマンドはコンテナに入らず、リポジトリのフォルダで次の形で実行します
  - `docker compose exec app php artisan ...`
  - `docker compose exec app composer ...`
- 起動：`docker compose up -d`／停止：`docker compose stop`
- 画面：http://localhost:8080 ／ Adminer（DBの確認）：http://localhost:8088

## 説明のしかた

- 日本語で、初心者にわかるように説明してください。専門用語には短い説明を添えてください
- コードを変更したら、どのファイルの何を変えたのかと、その理由を説明してください

## 守ってほしいこと

- 削除系の操作（`php artisan migrate:fresh`・`migrate:rollback`・`migrate:reset`、ファイルやフォルダの削除、`git reset --hard`、`git push --force`、ブランチの削除）は実行せず、受講生に「自分で打ってください」と伝えてください
- `php artisan migrate` などを実行する前は、何をするコマンドかを説明してください
- `.env` の中身やAPIキーを表示したり、コミットしたりしないでください
- Gitのコミット・push・mergeは、受講生に頼まれたときだけ行ってください

## この講座で使う書き方

- ユーザー登録・ログインは Laravel Fortify（画面はBladeで自作）
- 見た目は Bootstrap 5（CDNで読み込み）。npm・Viteのビルドは使わない
- ルートは `[UserController::class, 'index']` の形
- バリデーションはフォームリクエスト（`php artisan make:request`）
