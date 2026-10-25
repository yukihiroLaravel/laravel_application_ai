# 公開用（Render）のDockerfile。ローカルの開発では使いません
FROM php:8.4-apache

COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_pgsql pdo_mysql zip intl bcmath opcache

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
COPY docker/app/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/app/servername.conf /etc/apache2/conf-available/servername.conf
RUN a2enmod rewrite && a2enconf servername

WORKDIR /var/www/html
COPY . .

# 本番用にライブラリをインストール（開発用のライブラリは入れない）
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && chown -R www-data:www-data storage bootstrap/cache

COPY docker/render/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
