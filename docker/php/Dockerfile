FROM php:8-fpm

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions \
    opcache mcrypt \
    intl gmp imap \
    pdo_mysql \
    tidy redis xmlrpc \
    zip imagick gd exif

RUN pecl install xdebug \ 
    && docker-php-ext-enable xdebug

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www/html