FROM php:8.2.23-apache
ARG DEBIAN_FRONTEND=noninteractive
RUN docker-php-ext-install mysqli
# Include alternative DB driver
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN apt-get update \
    && apt-get install -y sendmail libpng-dev \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && apt-get install -y libonig-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

RUN a2enmod rewrite
#Xdebug Para poder ejecutar xdebug sobre nuestro entorno dockerizado, la imagen que tenemos debe ejecutar los siguientes puntos a través de nuestro Dockerfile hay que añadir las siguientes lineas.
RUN pecl install xdebug-3.3.2
ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
