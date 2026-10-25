FROM php:8.4-apache

# PHPの拡張機能（MySQL・PostgreSQL・zipなど）
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql pdo_pgsql zip intl bcmath opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# 作成したファイルの持ち主が自分のパソコンのユーザーと同じになるように、同じIDのユーザーで動かす
ARG UID=1000
ARG GID=1000
RUN groupadd -g ${GID} laravel || true \
    && useradd -m -u ${UID} -g ${GID} -s /bin/bash laravel || true

# Apache：publicフォルダを公開し、8080番で待ち受ける
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public \
    APACHE_RUN_USER=laravel \
    APACHE_RUN_GROUP=laravel
COPY docker/app/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/app/servername.conf /etc/apache2/conf-available/servername.conf
RUN a2enmod rewrite \
    && a2enconf servername \
    && sed -i 's/^Listen 80$/Listen 8080/' /etc/apache2/ports.conf \
    && chown -R ${UID}:${GID} /var/run/apache2 /var/lock/apache2 /var/log/apache2

COPY docker/app/php.ini /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/app/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html
USER laravel

EXPOSE 8080
ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
