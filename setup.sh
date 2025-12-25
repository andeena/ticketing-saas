#!/bin/bash

# Hentikan script jika ada error
set -e

echo "INITIALIZING SAAS DESKONE PROJECT (AUTO-SETUP)"

# Cek & Copy .env
if [ ! -f .env ]; then
    echo "[1/6] Copying .env file..."
    cp .env.example .env
    # mkdir -p storage/framework/{sessions,views,cache}
    # mkdir -p storage/app/public
    # mkdir -p bootstrap/cache
    # mkdir -p storage/logs

else
    echo "[1/6] .env file already exists."
fi

# Buat Network Docker
echo "[2/6] Setting up Docker Network..."
docker network create cloud-net 2>/dev/null || echo "Network 'cloud-net' already exists."

# Build Image Utama 
echo "[3/6] Building Base Docker Image..."
docker build --network=host -t ticketing-image .

echo "[4/6] Installing Dependencies (Composer) & Generating Key..."
echo "[4/7] Preparing Storage Directories on Host..."
# mkdir -p storage/framework/{sessions,views,cache}
# mkdir -p storage/app/public
# mkdir -p bootstrap/cache
# mkdir -p storage/logs
sudo chmod -R 777 storage bootstrap/cache
echo "Storage directories created."

echo "[5/6] Installing Dependencies (Composer) & Generating Key..."
docker run --rm --network=host \
    -v "$(pwd):/var/www/html" \
    ticketing-image \
    bash -c "composer install --no-interaction --prefer-dist && php artisan key:generate"
echo "vendor folder created & app_key generated."

# Nyalakan Gateway
echo "[5/6] Starting Gateway Service..."
cd gateway
docker compose up -d
cd ..
echo "Gateway is running on port 80."

chmod +x create-tenant.sh

echo "SETUP FINISHED!"