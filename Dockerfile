FROM composer

RUN apk update && \
    apk add nodejs npm yarn

WORKDIR /var/www

CMD sh entrypoint.sh
