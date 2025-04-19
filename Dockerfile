FROM php:8.2-apache

# 必要なPHP拡張などをインストール
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composerインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# プロジェクトファイルをコピー
COPY . /var/www/html

# Laravel用にApache設定
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# ドキュメントルートを Laravel の public に設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Apache設定の修正
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Laravel初期化（Renderではあとで自動でやる）
WORKDIR /var/www/html
