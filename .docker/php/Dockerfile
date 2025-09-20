FROM dunglas/frankenphp:php8.2

# Install dependencies
RUN apt-get update \
    && apt-get install -y \
    build-essential \
    zlib1g-dev \
    default-mysql-client \
    curl \
    gnupg \
    procps \
    vim \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

# Ekstensi dasar Laravel
RUN docker-php-ext-install \
    zip \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    intl \
    pcntl

# GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Redis
RUN pecl install redis && docker-php-ext-enable redis

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');"

# Node.js, NPM, Yarn
RUN curl -sL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest yarn

WORKDIR /app
