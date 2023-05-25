FROM php:8.2.3-apache

WORKDIR /var/www/html

RUN apt-get update \
    && a2enmod rewrite \
    && apt-get install -y --no-install-recommends libpq-dev libicu-dev libzip-dev libpng-dev libxml2-dev zip unzip git cron libonig-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo pdo_pgsql pdo_mysql zip soap calendar\
    && docker-php-ext-install bcmath mbstring \
    && docker-php-ext-install gd \
    && docker-php-ext-configure calendar \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && apt-get install -y build-essential \
    && apt-get install -y unixodbc-dev \
    && pecl install sqlsrv pdo_sqlsrv xdebug \
    && apt-get -y install vim \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Configurando o timezone do servidor
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

# Apache settings
COPY docker/extra/host.conf /etc/apache2/conf-enabled/host.conf
COPY docker/extra/000-default-backend.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/extra/apache2.conf /etc/apache2/apache2.conf

# PHP settings
COPY docker/extra/production.ini /usr/local/etc/php/conf.d/production.ini

# PHP settings
RUN mv /usr/local/etc/php/conf.d/production.ini /usr/local/etc/php/php.ini

# Update Php Settings
RUN sed -E -i -e 's/max_execution_time = 30/max_execution_time = 0/' /usr/local/etc/php/php.ini \
 && sed -E -i -e 's/memory_limit = 128M/memory_limit = 1024M/' /usr/local/etc/php/php.ini   \
 && sed -E -i -e 's/post_max_size = 8M/post_max_size = 1024M/' /usr/local/etc/php/php.ini   \
 && sed -E -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 1024M/' /usr/local/etc/php/php.ini

# COMPOSER
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install MS ODBC Driver for SQL Server
ENV ACCEPT_EULA=Y
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y --no-install-recommends install msodbcsql17 unixodbc-dev \
    && pecl install sqlsrv \
    && pecl install pdo_sqlsrv \
    && echo "extension=pdo_sqlsrv.so" >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-pdo_sqlsrv.ini \
    && echo "extension=sqlsrv.so" >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-sqlsrv.ini \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN php -v

# Create the log file to be able to run tail
RUN mkdir -p /var/log/cron

COPY docker/entrypoint.sh /usr/local/bin/
COPY . .

## Instalação dependencias composer
RUN composer update && php artisan config:clear && php artisan cache:clear
RUN chmod -R 777 /var/www/html/

RUN chmod +x /usr/local/bin/entrypoint.sh

CMD [ "sh", "-c", "/usr/local/bin/entrypoint.sh; /usr/local/bin/apache2-foreground" ]
