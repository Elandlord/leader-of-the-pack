#!/bin/sh
set -eu

cd /app

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Coolify volumes keep the files of the Nixpacks image, and artisan runs as root after a deploy.
chown -R nobody:nobody storage bootstrap/cache
if [ -d /data ]; then
    chown -R nobody:nobody /data
fi

exec "$@"
