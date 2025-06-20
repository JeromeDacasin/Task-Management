🛠️ Setup Instructions
✅ Step 1: Clone the Repository
Clone the repository and navigate into the project folder:

bash
Copy
Edit
git clone [repository](https://github.com/JeromeDacasin/Task-Management)
cd [repository](https://github.com/JeromeDacasin/Task-Management)
✅ Step 2: Create the .env File
Make sure a .env file exists in the root directory. If not, create one or copy from a sample:

bash
Copy
Edit
cp .env.example .env
Example .env content:

env
Copy
Edit
APP_PORT=8000
FRONTEND_PORT=3000
DB_HOST=db
DB_PORT=3306
REDIS_HOST=redis
✅ Step 3: Build and Start Docker Containers
Run the following command to build and start all services:

bash
Copy
Edit
docker-compose up --build
This will start:

Laravel backend

Vue or React frontend

Database, Redis, or other services defined in docker-compose.yml

✅ Step 4: Access the Application
Once the containers are running, you can access the application in your browser:

Frontend: http://localhost:5173
Backend: http://localhost


✅ Step 5: Run Laravel Commands (Optional)
Use the following commands to run Laravel tasks inside the backend container:

bash
Copy
Edit
# Run database migrations
docker exec -it laravel_app bash php artisan migrate

# Install PHP dependencies
docker exec -it laravel_app bash composer install


✅ Step 6: Stop All Containers
To stop and remove all running containers:

bash
Copy
Edit
docker-compose down
