.PHONY: run
run:
	docker-compose up -d
	symfony server:start -d
	yarn watch

.PHONY: stop
stop:
	docker-compose stop
	symfony server:stop

.PHONE: ci
ci:
	./vendor/bin/phpcs
	./vendor/bin/phpmd src,tests text phpmd.xml --suffixes php
	./vendor/bin/phpstan analyse -c phpstan.neon
	./vendor/bin/phpunit
	XDEBUG_MODE=coverage ./vendor/bin/infection -n --configuration=infection.json --threads=2

.PHONE: consumers
consumers:
	symfony console messenger:consume async -vv
