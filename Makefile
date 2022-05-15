init:
	docker compose exec app php artisan migrate
	docker compose exec app php artisan db:seed
test:
	docker compose exec app php artisan test
lint:
	docker compose exec app vendor/bin/grumphp run
