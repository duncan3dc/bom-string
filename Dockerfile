ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-cli

# Install pickle to help manage extensions
RUN apt-get update && apt-get install -y git libzip-dev zip && docker-php-ext-install zip
RUN curl --location https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar -o /usr/local/sbin/pickle
RUN chmod +x /usr/local/sbin/pickle

ARG COVERAGE
RUN if [ "$COVERAGE" = "pcov" ]; then pickle install pcov && docker-php-ext-enable pcov; fi

# Install composer to manage PHP dependencies
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --2.2 \
 && mv composer.phar /usr/local/bin/composer \
 && chmod +x /usr/local/bin/composer 

WORKDIR /app
