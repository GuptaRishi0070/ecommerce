# Use a base image suitable for PHP and your application requirements
FROM php:8.2-fpm

# Install additional system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-scripts --no-autoloader

# Copy the rest of your application code
COPY . .

# Set permissions if needed
RUN chown -R www-data:www-data /var/www/html

# Expose port if needed (usually not necessary for PHP-FPM)
# EXPOSE 9000

# Command to run PHP-FPM
CMD ["php-fpm"]
