#!/bin/bash
<<<<<<< HEAD
set -e
=======

# Cek parameter nama tenant
if [ -z "$1" ]; then
  echo "Usage: ./create-tenant.sh <tenant_name>"
  exit 1
fi
>>>>>>> cc5be4e093cd6cd8dcf736dd7d38dd4c1be5b007

TENANT=$1
CONTAINER_APP="${TENANT}_app"
# CONTAINER_APP=$(docker compose -p $TENANT ps -q app)


<<<<<<< HEAD
# 1. Pastikan Network ada
docker network inspect cloud-net >/dev/null 2>&1 || docker network create cloud-net

echo "Step 1: Running Docker Compose for $TENANT"
TENANT_NAME=$TENANT docker-compose -p "$TENANT" up -d

echo "Step 2: Waiting for container to stabilize..."
sleep 30

<<<<<<< HEAD
echo "Step 3: Finding artisan and Migrating"
# Kita cari di mana artisan berada dan jalankan php langsung di sana
ARTISAN_PATH=$(docker exec $CONTAINER_APP find /var/www -name artisan | head -n 1)

if [ -z "$ARTISAN_PATH" ]; then
    echo "ERROR: File artisan tidak ditemukan di dalam container!"
    exit 1
fi
=======
=======
echo "[1/3] Deploying DeskOne for tenant: $TENANT"

# Jalankan Container (PaaS Provisioning)
TENANT_NAME=$TENANT docker compose -p $TENANT up -d

echo "Waiting for container to start..."
sleep 5

>>>>>>> cc5be4e093cd6cd8dcf736dd7d38dd4c1be5b007
# Fix Permissions Otomatis 
echo "[2/3] Setting up permissions"
docker exec $CONTAINER_APP mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache
docker exec $CONTAINER_APP chmod -R 775 storage bootstrap/cache
docker exec $CONTAINER_APP php artisan optimize:clear
# docker exec -it $CONTAINER_APP bash
# chown -R www-data:www-data storage bootstrap/cache
# docker exec $CONTAINER_APP chmod -R 777 storage bootstrap/cache
# docker exec $CONTAINER_APP php artisan optimize:clear
<<<<<<< HEAD
>>>>>>> cc5be4e093cd6cd8dcf736dd7d38dd4c1be5b007

echo "Artisan found at: $ARTISAN_PATH"
docker exec -u root $CONTAINER_APP php $ARTISAN_PATH migrate --force

echo "Step 4: Setting Permissions"
# Ambil folder induk dari artisan path untuk chmod storage
BASE_DIR=$(dirname $ARTISAN_PATH)
docker exec -u root $CONTAINER_APP chmod -R 777 $BASE_DIR/storage $BASE_DIR/bootstrap/cache

echo "DONE! Tenant $TENANT is live."
=======

# migrate database
echo "[3/3] Migrating database"

sleep 10 
docker exec $CONTAINER_APP php artisan migrate --force

echo "SUCCESS! Tenant $TENANT is ready."
echo "Login at: http://$TENANT.localhost"
>>>>>>> cc5be4e093cd6cd8dcf736dd7d38dd4c1be5b007
