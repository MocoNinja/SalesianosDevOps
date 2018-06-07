FROM php:apache-jessie

RUN docker-php-ext-install mysqli

RUN mkdir -p /var/www/html/Salesianos

ADD ./BancodeTrabajo /var/www/html/Salesianos

EXPOSE 80
