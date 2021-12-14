start: deps
	docker-compose pull
	docker-compose up -d

copyJsLib:
	cp ./node_modules/@simplewebauthn/browser/dist/bundle/index.umd.min.js ./www/simplewebauthn/browser.js
	cp ./node_modules/@simplewebauthn/browser/LICENSE.md ./www/simplewebauthn/LICENSE.md

deps:
	docker-compose run --rm node npm install --ignore-scripts
	make copyJsLib

depsupdate:
	docker-compose run --rm node npm update --ignore-scripts
	make copyJsLib

errors:
	docker-compose exec hub cat /var/log/apache2/error.log
	docker-compose exec idp1 cat /var/log/apache2/error.log
	docker-compose exec idp2 cat /var/log/apache2/error.log
	docker-compose exec idp4 cat /var/log/apache2/error.log
	docker-compose exec hub2 cat /var/log/apache2/error.log
	docker-compose exec idp3 cat /var/log/apache2/error.log
	docker-compose exec sp cat /var/log/apache2/error.log

clean:
	docker-compose kill
	docker-compose rm -f
