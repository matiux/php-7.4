FROM matiux/php:7.4.1-fpm-alpine3.11-dev

USER root

RUN apk add --no-cache \
    openssh

COPY conf/xdebug-starter.sh /usr/local/bin/xdebug-starter
RUN chmod +x /usr/local/bin/xdebug-starter
RUN /usr/local/bin/xdebug-starter

USER utente

RUN echo 'alias test="./vendor/bin/simple-phpunit"' >> /home/utente/.bashrc
