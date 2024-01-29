# Use an official PHP runtime as a parent image
FROM php:8.2.12-fpm

# Set the working directory to /app
WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath soap \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the rest of the application code
COPY . .

# Set permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Expose port 8000 (assuming it's the port used by your Laravel application)
EXPOSE 8000

# Use CMD to define the default command to run when the container starts
CMD php artisan serve --host=0.0.0.0 --port=8000
