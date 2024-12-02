
# Laravel Docker Environment

This project provides a Docker-based development environment for a Laravel application. It includes the following services:

- **PHP-FPM** for running PHP.
- **Nginx** as the web server.
- **MySQL** as the database.
- **Redis** for caching and session storage.

## Prerequisites

- Docker: Ensure Docker is installed on your system. [Install Docker](https://docs.docker.com/get-docker/)
- Docker Compose: Included with Docker Desktop or install it separately. [Install Docker Compose](https://docs.docker.com/compose/install/)

## Setup

### 1. Clone the Repository
```bash
git clone <repository-url>
cd <project-folder>
```

### 2. Create `.env` File
Copy the `.env.example` file and configure environment variables for Laravel.
```bash
cp .env.example .env
```

Update the `.env` file with your database and Redis configurations:
```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=miraway
DB_USERNAME=miraway
DB_PASSWORD=miraway2024$

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 3. Build and Start Containers
Run the following command to build and start the containers:
```bash
docker-compose up -d --build
```

### 4. Install Laravel Dependencies
Execute the following command to install PHP dependencies inside the `app` container:
```bash
docker exec -it app composer install
```

### 5. Generate Application Key
Generate the Laravel application key:
```bash
docker exec -it app php artisan key:generate
```

### 6. Run Database Migrations
Run the migrations to set up the database schema:
```bash
docker exec -it app php artisan migrate
```

### 7. Access the Application
- Open your browser and navigate to: [http://localhost:8000](http://localhost:8000)

## Directory Structure

- `docker/`
  - Contains the configuration files for Docker services.
- `docker/php/local.ini`
  - PHP configuration file for customizing PHP settings.
- `docker/nginx/conf.d/`
  - Nginx configuration files.
- `docker/mysql/`
  - MySQL data directory (persistent storage).

## Common Commands

### Stop and Remove Containers
```bash
docker-compose down
```

### View Logs
```bash
docker-compose logs -f
```

### Enter a Running Container
```bash
docker exec -it <container_name> bash
```

## Troubleshooting

- **Port Conflicts**: Ensure ports `8000`, `3306`, and `6379` are not being used by other services.
- **Database Connection Issues**: Verify the `.env` file matches the `docker-compose.yml` configuration.
- **File Permission Errors**: Run the following command to fix permission issues:
  ```bash
  sudo chmod -R 777 storage bootstrap/cache
  ```
