PHP_CLI_RUN_CMD = docker-compose run --no-deps php-cli

## DEVELOPMENT ##
build:
	docker-compose build
.PHONY: build

start:
	docker-compose up -d
.PHONY: start

stop:
	docker-compose down
.PHONY: stop

clear-cache:
	$(PHP_CLI_RUN_CMD) rm -rf app/cache/* app/logs/* && mkdir -p app/cache app/logs/dev && chmod -R 0777 app/cache app/logs
.PHONY: clear-cache

cli:
	$(PHP_CLI_RUN_CMD) app/console $(ARGS)
.PHONY: cli

composer-install:
	$(PHP_CLI_RUN_CMD) composer install
.PHONY: composer-install

npm-install:
	$(PHP_CLI_RUN_CMD) npm install
.PHONY: npm-install

bower-install:
	$(PHP_CLI_RUN_CMD) bower install
.PHONY: bower-install

init: composer-install npm-install bower-install clear-cache
.PHONY: init

css:
	$(PHP_CLI_RUN_CMD) ./node_modules/.bin/gulp css
.PHONY: watch

watch: clear-cache
	$(PHP_CLI_RUN_CMD) ./node_modules/.bin/gulp watch
.PHONY: watch
