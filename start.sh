#!/usr/bin/env sh
set -e

# Ensure runtime-writable dirs exist (Render filesystem is ephemeral unless you add a disk)
mkdir -p storage bootstrap/cache

# Caches are optional; they may fail if APP_KEY is missing or routes use closures
php artisan config:cache >/dev/null 2>&1 || true
php artisan view:cache >/dev/null 2>&1 || true

# If you use storage:link in production, enable this (safe to re-run)
php artisan storage:link >/dev/null 2>&1 || true

if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
	php artisan migrate --force
fi

if [ "${RUN_SEED:-false}" = "true" ]; then
	php artisan db:seed --force
fi

exec php artisan serve --host 0.0.0.0 --port "${PORT:-8000}"
