FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    python3-venv \
    libjpeg-dev \
    libfreetype6-dev \
    libpng-dev \
    default-libmysqlclient-dev \
    curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN python3 -m venv /var/www/html/venv

RUN /var/www/html/venv/bin/pip install --no-cache-dir pandas matplotlib fpdf

WORKDIR /var/www/html

COPY composer.json composer.lock /var/www/html/
RUN composer install --no-dev --optimize-autoloader
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/vendor

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "index.php"]
