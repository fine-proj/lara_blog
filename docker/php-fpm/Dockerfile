FROM php:7.2.2-fpm
WORKDIR "/application"

RUN apt-get update && \
    apt-get install -y unzip && \
    apt-get install -y supervisor && \
    apt-get install -y libzip-dev && \
    apt-get install -y libpng-dev && \
    apt-get -y install git && \
    docker-php-ext-install pdo pdo_mysql gd mbstring zip xml && \
    apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY ./ /application

RUN php composer.phar update && chmod -R 777 . && php composer.phar dump-autoload

EXPOSE 9090

CMD cp ./.env.scenario.mail ./.env; php artisan l5-swagger:generate; service supervisor start; service cron start; chmod -R 777 .; php-fpm