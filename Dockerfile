FROM php:8.6-fpm-alpine AS base

RUN apk add --no-cache nginx supervisor \
    && apk add --no-cache --virtual .php-build $PHPIZE_DEPS oniguruma-dev icu-dev libzip-dev \
        freetype-dev libjpeg-turbo-dev libpng-dev libwebp-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j"$(nproc)" mbstring pdo_mysql intl exif zip gd bcmath \
    && apk add --no-cache --virtual .php-run $(scanelf --needed --nobanner --format '%n#p' --recursive \
        /usr/local/lib/php/extensions | tr ',' '\n' | sort -u | awk '{ print "so:" $1 }') \
    && apk del .php-build

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && rm -f /usr/local/etc/php-fpm.d/*.conf
COPY docker/php.ini "$PHP_INI_DIR/conf.d/zz-app.ini"
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod 755 /usr/local/bin/entrypoint

WORKDIR /app

FROM base AS app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --prefer-dist
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-interaction


FROM base

COPY --from=app /app /app
RUN chown -R nobody:nobody storage bootstrap/cache

EXPOSE 80
ENTRYPOINT ["entrypoint"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
