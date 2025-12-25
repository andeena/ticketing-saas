#!/bin/bash

# Cek parameter nama tenant
if [ -z "$1" ]; then
  echo "Usage: ./create-tenant.sh <tenant_name> [plan: free/pro]"
  exit 1
fi

TENANT=$1
PLAN=${2:-free}
CONTAINER_APP="${TENANT}_app"
# CONTAINER_APP=$(docker compose -p $TENANT ps -q app)


echo "[1/3] Deploying DeskOne ($PLAN Plan) for tenant: $TENANT"

# Jalankan Container (PaaS Provisioning)
TENANT_NAME=$TENANT docker compose -p $TENANT up -d
# docker-compose -p "$TENANT" up -d

echo "Waiting for container to start..."
sleep 10

# Fix Permissions Otomatis 
echo "[2/3] Setting up permissions"
docker exec $CONTAINER_APP mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache
# docker exec $CONTAINER_APP chmod -R 775 storage bootstrap/cache
# docker exec $CONTAINER_APP php artisan optimize:clear
# docker exec -it $CONTAINER_APP bash
# chown -R www-data:www-data storage bootstrap/cache
docker exec $CONTAINER_APP chmod -R 777 storage bootstrap/cache
# docker exec $CONTAINER_APP php artisan optimize:clear

# migrate database
echo "[3/3] Migrating database"

sleep 10 
docker exec $CONTAINER_APP php artisan migrate --force

# inject pricing plan
echo "Applying Pricing Plan: $PLAN"
docker exec $CONTAINER_DB mysql -u deskone -pdeskone deskone -e "
    INSERT IGNORE INTO tenants (id, name, created_at, updated_at) VALUES (1, '$TENANT', NOW(), NOW());
    UPDATE tenants SET plan='$PLAN' WHERE name='$TENANT';
"

echo "SUCCESS! Tenant $TENANT is ready."
echo "Login at: http://$TENANT.localhost"