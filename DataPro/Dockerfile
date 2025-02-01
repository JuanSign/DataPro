FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

RUN a2enmod rewrite

RUN echo "ServerName datapro-ij23.onrender.com" >> /etc/apache2/apache2.conf

RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/mods-enabled/dir.conf

WORKDIR /var/www/html

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/writable

EXPOSE 80

CMD ["apache2-foreground"]
