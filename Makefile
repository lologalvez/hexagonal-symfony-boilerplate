init:
	docker-compose up -d
	$(MAKE) install-dependencies
	$(MAKE) migrate-db

up:
	docker-compose up -d
	$(MAKE) migrate-db

down:
	docker-compose down

terminal:
	docker exec -it dummy.api bash

test:
	docker exec dummy.api ./vendor/bin/phpunit --configuration /app/phpunit.xml.dist

install-dependencies:
	docker exec dummy.api composer install

migrate-db: wait-mysql-connection
	docker exec dummy.api ./vendor/bin/doctrine-migrations migrate

wait-mysql-connection:
	docker-compose run dummy-api ./bin/wait-mysql-connection


