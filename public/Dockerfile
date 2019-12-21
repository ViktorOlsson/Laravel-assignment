FROM php:7.2.20
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /assignment
COPY . /assignment
RUN composer install

CMD php artisan serve --host=172.17.0.7 --port=8000
EXPOSE 8000