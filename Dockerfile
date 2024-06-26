ARG PHP_VERSION=7.2
FROM php:${PHP_VERSION}-cli

ARG COVERAGE
RUN if [ "$COVERAGE" = "pcov" ]; then pecl install pcov && docker-php-ext-enable pcov; fi

# Install composer to manage PHP dependencies
RUN apt update && apt install -y git zip
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN echo "if [[ $PHP_VERSION == 7.* ]]; then composer self-update --1; fi" > composer.sh
RUN bash composer.sh

WORKDIR /app
