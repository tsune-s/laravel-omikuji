FROM php:8.2-apache

# 必要パッケージ
RUN apt-get update && apt-get install -y \
    git zip unzip curl libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer追加
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravelを配置
COPY . /var/www/html

# Apacheの公開ディレクトリ設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# mod_rewriteを有効にする
RUN a2enmod rewrite

# 作業ディレクトリを設定
WORKDIR /var/www/html

# ダミーの.envを作成（APP_KEYはRenderのEnvironment変数で設定済み前提）
RUN echo "APP_KEY=${APP_KEY}" > .env

# Composerインストールだけはビルド中に実行（安全）
RUN composer install --no-dev --optimize-autoloader

# ←この部分を ↓ に置き換える
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache


# Laravelキャッシュ生成 → Apache起動
CMD php artisan config:cache && apache2-foreground

