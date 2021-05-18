FROM php:7.4-cli-buster

COPY php.ini /usr/local/etc/php/php.ini
COPY xdebug.ini /xdebug.ini

RUN apt-get update
RUN pecl install xdebug
RUN apt-get install -y --no-install-recommends \
    acl apt-transport-https apt-utils \
    build-essential curl debconf \
    git gnupg gnupg1 gnupg2 \
    libjpeg-dev libldb-dev libldap2-dev libonig-dev libpq-dev libpng-dev libicu-dev \
    libssl-dev libxml2 libicu-dev libxpm-dev libzip-dev libzip4 locales \
    mailutils openssl sudo unzip wget zip zlib1g-dev
RUN apt-get autoremove && apt-get clean
RUN rm -rf /var/lib/apt/lists/* && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && locale-gen
RUN docker-php-ext-install bcmath exif gd intl ldap opcache sockets zip

COPY entrypoint.sh /entrypoint.sh
RUN chmod 755 /entrypoint.sh

WORKDIR /var/www

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && mv composer.phar /usr/local/bin/composer &&\
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - &&\
    curl -sL https://deb.nodesource.com/setup_14.x | bash - &&\
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list &&\
    apt-get update && apt-get install -y --no-install-recommends --no-install-suggests supervisor nodejs yarn &&\
    npm install -g bower

COPY supervisor.conf /etc/supervisor/conf.d/supervisor.conf
CMD ["/entrypoint.sh"]