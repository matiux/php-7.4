FROM matiux/php:7.4.2-fpm-buster-dev

USER root

RUN apt-get update && apt-get install -y --no-install-recommends \
    golang \
    iproute2 \
    libffi-dev \
    ssh \
    strace \
    && docker-php-ext-configure ffi --with-ffi \
    && docker-php-ext-install ffi

COPY conf/preload.ini $PHP_INI_DIR/conf.d/

COPY conf/xdebug-starter.sh /usr/local/bin/xdebug-starter
RUN chmod +x /usr/local/bin/xdebug-starter
RUN /usr/local/bin/xdebug-starter

USER utente
