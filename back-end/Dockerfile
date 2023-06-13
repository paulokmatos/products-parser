FROM php:8.1-fpm-alpine

WORKDIR /var/www/html/project

RUN apk update \
    && apk upgrade \
    && apk add git tzdata wget

# Set timezone
ENV TZ=America/Sao_Paulo

# Install dependencies
RUN apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
  libxml2-dev curl-dev linux-headers oniguruma-dev imap-dev openssl-dev libpng-dev libzip-dev zip

# install extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql dom curl mbstring imap opcache gd zip

RUN apk add --no-cache mysql-client msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip && \
    apk del build-essentials && rm -rf /usr/src/php*

# Composer
RUN \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && HASH="$(wget -q -O - https://composer.github.io/installer.sig)" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Setup cron
RUN echo '*  *  *  *  * /usr/local/bin/php  /var/www/html/project/artisan schedule:run >> /dev/null 2>&1' > /etc/crontabs/root

COPY ./ ./

RUN composer install

# Setting permissions
RUN \
    chown -R www-data:www-data /var/www/html/project && \
    find /var/www/html/project -type f -exec chmod 644 {} \; && \
    find /var/www/html/project -type d -exec chmod 755 {} \;

EXPOSE 80 443

# Remove Build Dependencies
RUN apk del -f $PHPIZE_DEPS libxml2-dev curl-dev linux-headers oniguruma-dev imap-dev openssl-dev

CMD ["php", "artisan", "serve"]