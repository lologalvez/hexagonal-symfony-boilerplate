init:
	docker-compose up --build -d
	$(MAKE) install-dependencies
	$(MAKE) migrate-db

up:
	docker-compose up -d
	$(MAKE) migrate-db

down:
	docker-compose down

terminal:
	docker exec -it api bash

test:
	docker exec api ./vendor/bin/phpunit --configuration /app/phpunit.xml.dist

install-dependencies:
	docker exec api composer install

migrate-db: wait-mysql-connection
	docker exec api ./vendor/bin/doctrine-migrations migrate

wait-mysql-connection:
	docker-compose run api ./bin/wait-mysql-connection


