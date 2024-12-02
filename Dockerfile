FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev && \
    docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /Users/softradix/Documents/PHP/acme-widget-co

# Install project dependencies
COPY composer.json composer.lock ./
RUN composer install

# Copy source code
COPY . .

# Expose the development server port
EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/Users/softradix/Documents/PHP/acme-widget-co"]
