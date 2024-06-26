ARG PHP_VERSION=7.2
FROM php:${PHP_VERSION}-cli

# Install pickle to help manage extensions
RUN apt-get update && apt-get install -y git libzip-dev zip && docker-php-ext-install zip
RUN curl --location https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar -o /usr/local/sbin/pickle
RUN chmod +x /usr/local/sbin/pickle

ARG COVERAGE
RUN if [ "$COVERAGE" = "pcov" ]; then pickle install pcov && docker-php-ext-enable pcov; fi

# Install composer to manage PHP dependencies
RUN apt update && apt install -y git zip
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN echo "if [[ $PHP_VERSION == 7.* ]]; then composer self-update --1; fi" > composer.sh
RUN bash composer.sh

WORKDIR /app
