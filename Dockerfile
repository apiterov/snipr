FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    libmemcached-dev \
    zlib1g-dev \
    libssl-dev \
    && pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

COPY app /var/www/html

RUN apt-get install -y nginx

COPY ./_docker/nginx.conf /etc/nginx/nginx.conf
COPY ./_docker/default.conf /etc/nginx/conf.d/default.conf
COPY ./.env /var/www/.env

EXPOSE 80

RUN nginx -t

CMD service nginx start && php-fpm