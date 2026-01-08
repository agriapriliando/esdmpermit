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
    libpng-dev \
    supervisor \
    libmagickwand-dev --no-install-recommends

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

# Imagick
RUN pecl install imagick && docker-php-ext-enable imagick

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /app

COPY . /app

COPY Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
