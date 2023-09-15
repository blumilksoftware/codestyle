DOCKER_COMPOSE_FILENAME=docker-compose.yml
PHP_FPM_SERVICE_NAME=php

.PHONY: shell
shell:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} exec ${PHP_FPM_SERVICE_NAME} ash

.PHONY: run
run:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} up -d

.PHONY: stop
stop:
	docker compose -f ${DOCKER_COMPOSE_FILENAME} stop

.PHONY: restart
restart: stop run
