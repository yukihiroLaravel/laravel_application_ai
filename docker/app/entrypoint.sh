#!/bin/bash
# コンテナ起動時の自動セットアップ
set -e

cd /var/www/html

# ライブラリ（vendor）がなければインストール
if [ ! -f vendor/autoload.php ]; then
    echo "[setup] composer install を実行します（初回は数分かかります）"
    composer install --no-interaction --prefer-dist
fi

# .env がなければ .env.example からコピー
if [ ! -f .env ]; then
    echo "[setup] .env を作成します"
    cp .env.example .env
fi

# アプリキーが空なら作成
if ! grep -q '^APP_KEY=base64:' .env; then
    echo "[setup] アプリキーを作成します"
    php artisan key:generate --force
fi

echo "[setup] 準備完了：http://localhost:8080"
exec "$@"
