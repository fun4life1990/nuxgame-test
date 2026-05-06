# NuxGame — Local Setup Guide

This project is a Laravel application using MySQL and Docker (Nginx + PHP-FPM). Follow the steps below to run it locally.

## Stack

- **PHP** 8.4 (FPM)
- **Laravel** 13
- **MariaDB** 10.3

## Getting Started

### Prerequisites

- Docker & Docker Compose
- Free ports: 14000, 14006

### Setup

```bash
cp .env.example .env
docker compose up -d
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

## Services

| Service | Port  |
|---------|-------|
| Web     | 14000 |
| Db      | 14006 |

## Development

```bash
# Start containers
docker compose up -d

# Run Artisan commands
docker compose exec app php artisan <command>

# Run Composer commands
docker compose exec app composer <command>
```

## Code Style

```bash
docker compose exec app vendor/bin/pint --dirty
```

## Access the application
- Open http://localhost:14000

## Xdebug

Xdebug is pre-configured. Set `XDEBUG_STORM_PORT` and `XDEBUG_STORM_SERVER_NAME` in `.env` to match your IDE settings.
