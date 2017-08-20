up:
	docker-compose up -d

exec:
	docker-compose exec php bash

chmod:
	docker-compose run --rm php chmod -R 777 var/
