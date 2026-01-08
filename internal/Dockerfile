FROM dunglas/frankenphp:php8.2

WORKDIR /app

COPY . /app

EXPOSE 80

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
