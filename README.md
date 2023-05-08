## Prerequisites for installation
Docker
Docker Compose
Preferably a Mac or Linux PC
## Installation
- Clone the git repository on your local machine
- Inside the project root dir, please run: `docker build . -t user_management --no-cache` to build the docker image.
- Inside the project root dir, please run: `docker-compose up -d` to start the application.
- Inside the project root dir, please run: 
  `docker exec -it learnci_application_1 bash -c "composer install; php spark migrate"` to init the application.
#### Once started:
- the web application will be available at: http://127.0.0.1:8080
- the database will be available at: `127.0.0.1` port `3306` (user root, password root)