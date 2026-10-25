#!/bin/bash
# 公開用（Render）の起動処理
set -e

cd /var/www/html

# Renderが指定するポート番号（PORT）で待ち受ける
PORT="${PORT:-8080}"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# 設定・ルート・画面をキャッシュして速くする
php artisan config:cache
php artisan route:cache
php artisan view:cache

# テーブルを作成・更新する
php artisan migrate --force

exec "$@"
