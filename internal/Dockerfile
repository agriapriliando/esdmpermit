FROM dunglas/frankenphp:php8.2

WORKDIR /app

COPY . /app

COPY Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 80

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
