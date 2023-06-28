.PHONY: install
install:
	composer install

.PHONY: phpcs
phpcs:
	./vendor/bin/phpcs --standard=./vendor/spryker/code-sniffer/Spryker/ruleset.xml ./src/FondOfKudu/* ./tests/*

.PHONY: phpcbf
phpcbf:
	./vendor/bin/phpcbf --standard=./vendor/spryker/code-sniffer/Spryker/ruleset.xml ./src/FondOfKudu/* ./tests/*

.PHONY: phpstan
phpstan:
	./vendor/bin/phpstan --memory-limit=-1 analyse ./src/FondOfKudu ./tests

.PHONY: codeception
codeception:
	./vendor/bin/codecept run --env standalone --coverage --coverage-xml --coverage-html

.PHONY: ci
ci: phpcs codeception phpstan
