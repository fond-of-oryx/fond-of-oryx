BASE_DIRECTORY ?= $(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

.PHONY: install
install:
	composer install

.PHONY: phpcs
phpcs:
	./vendor/bin/phpcs --standard=./vendor/spryker/code-sniffer/Spryker/ruleset.xml ./bundles/*

.PHONY: phpstan
phpstan:
	./vendor/bin/phpstan analyse ./bundles/*/src/

.PHONY: codeception
codeception:
	./vendor/bin/codecept run --env standalone --coverage --coverage-xml --coverage-html

.PHONY: prepare-dandelion-config
prepare-dandelion-config:
	sed -i "s/<GITHUB_TOKEN>/$(GITHUB_TOKEN)/" $(BASE_DIRECTORY)/dandelion.json

.PHONY: split
split:
	docker run -i -v $(BASE_DIRECTORY):/home/dandelion/project -w /home/dandelion/project dandelionphp/dandelion:latest dandelion split:all $(BRANCH)

.PHONY: release
release:
	docker run -i -v $(BASE_DIRECTORY):/home/dandelion/project -w /home/dandelion/project dandelionphp/dandelion:latest dandelion release:all $(BRANCH)

.PHONY: ci
ci: phpcs codeception phpstan
