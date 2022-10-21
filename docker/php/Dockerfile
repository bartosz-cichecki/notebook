FROM php:8.1-fpm

#common soft
RUN apt-get update
RUN apt-get install --fix-missing -y wget unzip autoconf pkg-config procps acl

#zip
RUN apt-get install -y libzip-dev && docker-php-ext-install zip

#xdebug
ARG XDEBUG_REMOTE_HOST=127.0.0.1
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=${XDEBUG_REMOTE_HOST}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#postgres
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

#composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && HASH="$(wget -q -O - https://composer.github.io/installer.sig)" \
    && php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer

#symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony
RUN mkdir "/var/www/var"
RUN HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
RUN setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX /var/www/var
RUN setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX /var/www/var


#zsh
RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.1.2/zsh-in-docker.sh)" -- \
    -t robbyrussell

