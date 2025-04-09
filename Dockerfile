FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

COPY ./src /var/www/html

RUN apt-get install -y nginx

COPY ./_docker/nginx.conf /etc/nginx/nginx.conf
COPY ./_docker/default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

RUN nginx -t

CMD service nginx start && php-fpm