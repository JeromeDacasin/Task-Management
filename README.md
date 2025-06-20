
## 🛠️ Setup Instructions

### ✅ Step 1: Clone the Repository

Clone the repository and navigate into the project folder:

```bash
git clone https://github.com/JeromeDacasin/Task-Management.git
cd Task-Management
```

### ✅ Step 2: Create the `.env` File

Make sure a `.env` file exists in the root directory. If not, create one or copy from a sample:

```bash
cp .env.example .env
```

Example `.env` content:

```env
APP_PORT=8000
FRONTEND_PORT=3000
DB_HOST=db
DB_PORT=3306
REDIS_HOST=redis
```

### ✅ Step 3: Build and Start Docker Containers

Run the following command to build and start all services:

```bash
docker-compose up --build
```

This will start:

- Laravel backend  
- Vue or React frontend  
- Database, Redis, or other services defined in `docker-compose.yml`

### ✅ Step 4: Access the Application

Once the containers are running, open the application in your browser:

- Frontend: http://localhost:5173  
- Backend: http://localhost

### ✅ Step 5: Run Laravel Commands (Optional)

Use the following commands to run Laravel tasks inside the backend container:

```bash
# Run database migrations
docker exec -it laravel_app php artisan migrate

# Install PHP dependencies
docker exec -it laravel_app composer install
```

### ✅ Step 6: Stop All Containers

To stop and remove all running containers:

```bash
docker-compose down
```
