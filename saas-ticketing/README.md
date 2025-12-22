# DeskOne - SaaS Helpdesk (On-Premise)

## Tech Stack
- Laravel
- MySQL
- Docker
- Docker Compose

## Cara Menjalankan
```bash
git clone https://github.com/username/deskone.git
cd deskone
cp .env.example .env
docker compose up -d --build
docker compose exec app php artisan migrate
