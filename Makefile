init:
	docker-compose up -d
	docker-compose exec app composer update
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate
