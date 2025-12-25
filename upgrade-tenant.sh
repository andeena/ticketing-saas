#!/bin/bash

# Cek argumen
if [ -z "$1" ] || [ -z "$2" ]; then
  echo "Usage: ./upgrade-tenant.sh <tenant_name> <new_plan>"
  exit 1
fi

TENANT=$1
NEW_PLAN=$2
CONTAINER_DB="${TENANT}_db"

if ! docker ps | grep -q "$CONTAINER_DB"; then
  echo "Error: Tenant '$TENANT' tidak ditemukan atau sedang mati."
  exit 1
fi

echo "Upgrading $TENANT to '$NEW_PLAN' Plan..."

# Update Database via SQL
docker exec $CONTAINER_DB mysql -u deskone -pdeskone deskone -e "
    UPDATE tenants SET plan='$NEW_PLAN' WHERE id=1;
"

echo "SUCCESS! $TENANT is now on $NEW_PLAN plan."
echo "Silakan refresh browser untuk menikmati fitur baru."