FROM dunglas/frankenphp:php8.2

WORKDIR /app

COPY . /app

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
