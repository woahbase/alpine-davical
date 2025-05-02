# syntax=docker/dockerfile:1
#
ARG IMAGEBASE=frommakefile
#
FROM ${IMAGEBASE}
#
# php version arg/envvar inherited from alpine-php
# ARG PHPMAJMIN
# ENV \
#     PHPMAJMIN=${PHPMAJMIN}
#
ARG AWLVERSION
ARG VERSION
#
ENV \
    AWL_SRC="/opt/davical/awl-r${AWLVERSION}.tar.gz" \
    DAVI_SRC="/opt/davical/davical-r${VERSION}.tar.gz" \
    NGINX_NO_HTPASSWD=true \
    SKIP_CRON=true
#
RUN set -xe \
    && apk add --no-cache --purge -uU \
        curl \
        gzip \
        icu-libs \
#
        iputils \
        perl \
        perl-dbd-pg \
        perl-dbi \
        perl-yaml \
        postgresql-client \
#
        # php${PHPMAJMIN}-apache2 \
        php${PHPMAJMIN}-calendar \
        php${PHPMAJMIN}-cgi \
        php${PHPMAJMIN}-curl \
        php${PHPMAJMIN}-gettext \
        php${PHPMAJMIN}-iconv \
        php${PHPMAJMIN}-gettext \
        php${PHPMAJMIN}-imap \
        php${PHPMAJMIN}-intl \
        php${PHPMAJMIN}-ldap \
        php${PHPMAJMIN}-openssl \
        php${PHPMAJMIN}-pdo \
        php${PHPMAJMIN}-pdo_pgsql \
        php${PHPMAJMIN}-pgsql \
        php${PHPMAJMIN}-session \
        php${PHPMAJMIN}-xml \
        php${PHPMAJMIN}-zip \
#
    && mkdir -p \
        /defaults \
        /opt/davical \
        /etc/davical \
#
    && if [ -f "/etc/php${PHPMAJMIN}/php.ini" ]; then mv /etc/php${PHPMAJMIN}/php.ini /defaults/php.ini; fi \
    && if [ -f "/etc/php${PHPMAJMIN}/php-fpm.conf" ]; then mv /etc/php${PHPMAJMIN}/php-fpm.conf /defaults/php-fpm.conf; fi \
    && if [ -f "/etc/php${PHPMAJMIN}/php-fpm.d/www.conf" ]; then mv /etc/php${PHPMAJMIN}/php-fpm.d/www.conf /defaults/php-fpm-www.conf; fi \
#
    && echo "${AWLVERSION}" > /opt/davical/awlversion \
    && curl \
        -o "${AWL_SRC}" \
        -jSL "https://gitlab.com/davical-project/awl/-/archive/r${AWLVERSION}/awl-r${AWLVERSION}.tar.gz" \
    && echo "${VERSION}" > /opt/davical/version \
    && curl \
        -o "${DAVI_SRC}" \
        -jSL "https://gitlab.com/davical-project/davical/-/archive/r${VERSION}/davical-r${VERSION}.tar.gz" \
#
    && apk del --purge curl \
    && rm -rf /var/cache/apk/* /tmp/*

# add local files
COPY root/ /
#
HEALTHCHECK \
    --interval=2m \
    --retries=5 \
    --start-period=5m \
    --timeout=10s \
    CMD \
    wget --quiet --tries=1 --no-check-certificate --spider ${HEALTHCHECK_URL:-"http://localhost:80/index.php"} || exit 1
#
# ports, volumes etc from nginx
# ENTRYPOINT ["/init"]
