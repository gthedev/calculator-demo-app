FROM php:8.0-cli

# Install basic requirements & extensions
RUN apt-get update -yqq \
    && apt-get install -y --no-install-recommends \
        git \
        zip \
        libzip-dev \
     && docker-php-ext-install zip


# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

COPY . /var/www/html
WORKDIR /var/www/html