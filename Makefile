.PHONY: dependency-install dependency-purge coding-standards static-code-analysis static-code-analysis-baseline core-coverage core-architecture-check

help:
	@awk 'BEGIN {FS = ":.*##"; printf "Use: make \033[36m<target>\033[0m\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2 } /^##@/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 5) } ' $(MAKEFILE_LIST)

.PHONY: init
init:  ## Initialize dev environment
	- docker-compose run encore yarn install
	- make up

.PHONY: up
up:  ## Start docker-compose
	- make down
	- docker-compose up -d

.PHONY: down
down:  ## Stop docker-compose
	- docker-compose down -v --remove-orphans

.PHONY: status
status:  ## Show containers status
	- docker-compose ps

.PHONY: bash
bash:  ## Open a bash terminal inside php container
	- docker-compose exec app bash


.PHONY: dependency-install
dependency-install:  ## Install all dependency with composer
	composer install
	composer bin all install


.PHONY: dependency-purge
dependency-purge:  ## Remove all dependency
	rm -fR vendor
	rm -fR tools/*/vendor
	rm -fR var/logs
	rm -fR tools/cache
	rm -fR var/tools
#	rm -fR bin/.phpunit


.PHONY: coding-standards
coding-standards: ## Fixes code style issues with easy-coding-standard
	mkdir -p var/tools/ecs
	vendor/bin/ecs check --fix --verbose

.PHONY: static-code-analysis
static-code-analysis: ## Runs a static code analysis with phpstan/phpstan and vimeo/psalm
	mkdir -p var/tools/phpstan
	vendor/bin/phpstan --configuration=phpstan.neon --memory-limit=-1
	mkdir -p var/tools/psalm
	vendor/bin/psalm --config psalm.xml --diff --show-info=false --stats --threads=4


.PHONY: static-code-analysis-baseline
static-code-analysis-baseline: vendor ## Generates a baseline for static code analysis with phpstan/phpstan and vimeo/psalm
	mkdir -p var/tools/phpstan
	vendor/bin/phpstan --configuration=phpstan.neon --generate-baseline --memory-limit=-1  || true
	mkdir -p var/tools/psalm
	vendor/bin/psalm --config=psalm.xml --set-baseline=psalm-baseline.xml

.PHONY: core-tests
core-tests: ## Runs unit tests For Core code with phpunit/phpunit
	mkdir -p var/tools/phpunit/core
	vendor/bin/phpunit --configuration phpunit.core.xml --coverage-text


.PHONY: core-coverage
core-coverage: ## Collects Core code coverage from running unit tests with phpunit/phpunit
	mkdir -p var/tools/phpunit/core
	vendor/bin/phpunit --configuration phpunit.core.xml --coverage-html var/coverage/core

.PHONY: core-architecture-check
core-architecture-check:  ## Check Core code architecture roules with deptrac
	vendor/bin/deptrac analyse core/depfile-core.yaml --report-uncovered
	vendor/bin/deptrac analyse core/depfile-publicjob.yaml
	vendor/bin/deptrac analyse core/depfile-errata.yaml