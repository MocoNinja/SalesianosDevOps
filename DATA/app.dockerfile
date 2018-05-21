FROM php:apache-jessie

RUN docker-php-ext-install mysqli

ADD ./BancodeTrabajo /var/www/html

EXPOSE 80
