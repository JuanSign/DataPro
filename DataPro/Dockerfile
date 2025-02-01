FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libicu-dev zip git \
    libmariadb-dev-compat libmariadb-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql intl mysqli

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default.conf

RUN echo "ServerName datapro-ij23.onrender.com" >> /etc/apache2/apache2.conf

RUN mkdir -p writable \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 writable

EXPOSE 80

CMD ["apache2-foreground"]
