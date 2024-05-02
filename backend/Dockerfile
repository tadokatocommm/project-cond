# Use the official PHP image
FROM php:8.2-fpm

# Set the working directory
WORKDIR /var/www/html

# Install PHP dependencies
RUN apt-get -y update && \
    apt-get -y install curl nano git vim zip unzip libxml2-dev libmemcached-dev libmcrypt-dev zlib1g-dev libsodium-dev && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mysqli pdo pdo_mysql  xml pcntl intl fileinfo sockets bcmath sockets sodium exif \
    && docker-php-ext-enable mysqli pdo pdo_mysql  xml pcntl intl fileinfo sockets bcmath sockets sodium exif


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json and composer.lock
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Copy application code
COPY . .

# Copy .env file
COPY .env /var/www/html

# Generate autoload files
RUN composer dump-autoload

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
