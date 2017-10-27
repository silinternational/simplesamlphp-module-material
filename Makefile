start:
	docker-compose up -d

errors:
	docker-compose exec hub cat /var/log/apache2/error.log
	docker-compose exec idp1 cat /var/log/apache2/error.log
	docker-compose exec idp2 cat /var/log/apache2/error.log
	docker-compose exec idp4 cat /var/log/apache2/error.log
	docker-compose exec hub2 cat /var/log/apache2/error.log
	docker-compose exec idp3 cat /var/log/apache2/error.log

clean:
	docker-compose kill
	docker system prune -f


# TODO: create local migrations for broker to load users and mfas to make testing easier.
