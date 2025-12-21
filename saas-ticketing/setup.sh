#!/bin/bash

# Hentikan script jika ada error
set -e

echo "INITIALIZING SAAS DESKONE PROJECT (AUTO-SETUP)"

# Cek & Copy .env
if [ ! -f .env ]; then
    echo "[1/5] Copying .env file..."
    cp .env.example .env
else
    echo "[1/5] .env file already exists."
fi

# Buat Network Docker
echo "[2/5] Setting up Docker Network..."
docker network create cloud-net 2>/dev/null || echo "Network 'cloud-net' already exists."

# Build Image Utama 
echo "[3/5] Building Base Docker Image..."
docker build --network=host -t ticketing-image .

# Nyalakan Gateway
echo "[4/5] Starting Gateway Service..."
cd gateway
docker compose up -d
cd ..
echo "Gateway is running on port 80."

chmod +x create-tenant.sh

echo "SETUP FINISHED!"

# read -p "Do you want to create a demo tenant 'demo' now? (y/n) " -n 1 -r
# echo
# if [[ $REPLY =~ ^[Yy]$ ]]
# then
#     ./create-tenant.sh demo
# else
#     echo "OK. You can create a tenant later using: ./create-tenant.sh <name>"
# fi