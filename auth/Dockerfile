FROM php:8.2-cli

RUN apt-get update && apt-get install -y libmariadb-dev \
    && docker-php-ext-install mysqli

WORKDIR /auth

COPY . .

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]
