FROM php:8.2-apache

# 必要パッケージのインストール
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composerを追加
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# プロジェクトファイルをコピー
COPY . /var/www/html

# Apacheの公開ディレクトリ設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# mod_rewrite 有効化（Laravel必須）
RUN a2enmod rewrite

# 作業ディレクトリを設定
WORKDIR /var/www/html

# .env ファイルがなければ作る（Render側でAPP_KEYなどを環境変数で渡す想定）
RUN test -f .env || echo "APP_KEY=${APP_KEY}" > .env

# 依存関係インストール（本番最適化）
RUN composer install --no-dev --optimize-autoloader

# ✅ SQLite 書き込み対応（← ここが超重要！）
RUN chmod -R 777 /var/www/html/database

# Laravelが書き込みを必要とするディレクトリに権限付与
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Laravel設定キャッシュ → Apache起動
CMD php artisan config:cache && apache2-foreground
