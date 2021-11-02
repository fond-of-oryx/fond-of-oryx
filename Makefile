BASE_DIRECTORY ?= $(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

.PHONY: install
install:
	composer install

.PHONY: phpcs
phpcs:
	./vendor/bin/phpcs --standard=./vendor/spryker/code-sniffer/Spryker/ruleset.xml ./bundles/*

.PHONY: phpcbf
phpcbf:
	./vendor/bin/phpcbf --standard=./vendor/spryker/code-sniffer/Spryker/ruleset.xml ./bundles/*

.PHONY: phpstan
phpstan:
	./vendor/bin/phpstan --memory-limit=-1 analyse ./bundles/*/src/

.PHONY: codeception
codeception:
	./vendor/bin/codecept run --env standalone --coverage --coverage-xml --coverage-html

.PHONY: codeception-without-coverage
codeception-without-coverage:
	./vendor/bin/codecept run --env standalone

.PHONY: prepare-dandelion-config
prepare-dandelion-config:
	sed -i "s/<GITHUB_TOKEN>/$(GITHUB_TOKEN)/" $(BASE_DIRECTORY)/dandelion.json

.PHONY: init-split-repos
init-split-repos:
	docker run -i -v $(BASE_DIRECTORY):/home/dandelion/project -w /home/dandelion/project dandelionphp/dandelion:latest dandelion split-repository:init:all

.PHONY: split
split:
	docker run -i -v $(BASE_DIRECTORY):/home/dandelion/project -w /home/dandelion/project dandelionphp/dandelion:latest dandelion split:all $(BRANCH)

.PHONY: release
release:
	docker run -i -v $(BASE_DIRECTORY):/home/dandelion/project -w /home/dandelion/project dandelionphp/dandelion:latest dandelion release:all $(BRANCH)

.PHONY: ci
ci: phpcs codeception phpstan

.PHONY: print-composer-replace-content
print-composer-replace-content:
	./Makefile.d/composer.sh print_replace_content

.PHONY: add-all-to-packagist
add-all-to-packagist:
	./Makefile.d/packagist.sh add_all
