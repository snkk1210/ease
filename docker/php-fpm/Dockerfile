FROM php:7.4.8-fpm

RUN apt-get update && apt-get install -y git zip unzip ansible sshpass
RUN docker-php-ext-install pdo_mysql

RUN useradd -m -s /bin/sh -u 1000 nginx

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN mkdir -p /app
ADD . /app/

WORKDIR /app

RUN composer install
RUN php artisan migrate
RUN php artisan key:generate
RUN chmod -R 777 storage/
RUN git clone https://github.com/keisukesanuki/default-CentOS7.git storage/app/default-CentOS7
RUN chown nginx:nginx storage/app/default-CentOS7
RUN chown nginx:nginx storage/app/default-CentOS7/group_vars
RUN chmod 777 /var/www
