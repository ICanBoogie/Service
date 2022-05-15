# This is the base image for CLI containers, to speed up building.
# https://hub.docker.com/_/php/
FROM php:7.2-cli-buster

RUN docker-php-ext-enable opcache

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apt-get update && \
	apt-get install unzip && \
    curl -s https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer | php -- --quiet && \
    mv composer.phar /usr/local/bin/composer
