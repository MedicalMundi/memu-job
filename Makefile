.PHONY: dependency-install
dependency-install:  ## Install all dependency with composer
	composer install
	composer bin all install


.PHONY: dependency-purge
dependency-purge:  ## Remove all dependency
	rm -fR vendor
	rm -fR tools/*/vendor
	rm -fR bin/.phpunit


.PHONY: coding-standards
coding-standards: ## Fixes code style issues with easy-coding-standard
	mkdir -p .build/ecs
	vendor/bin/ecs check --fix --verbose

.PHONY: static-code-analysis
static-code-analysis: ## Runs a static code analysis with phpstan/phpstan and vimeo/psalm
	mkdir -p .build/phpstan
	vendor/bin/phpstan --configuration=phpstan.neon --memory-limit=-1
	mkdir -p .build/psalm
	vendor/bin/psalm --config psalm.xml --diff --show-info=false --stats --threads=4


.PHONY: static-code-analysis-baseline
static-code-analysis-baseline: vendor ## Generates a baseline for static code analysis with phpstan/phpstan and vimeo/psalm
	mkdir -p .build/phpstan
	vendor/bin/phpstan --configuration=phpstan.neon --generate-baseline --memory-limit=-1  || true
	mkdir -p .build/psalm
	vendor/bin/psalm --config=psalm.xml --set-baseline=psalm-baseline.xml

.PHONY: core-tests
core-tests: ## Runs unit tests For Core code with phpunit/phpunit
	mkdir -p .build/phpunit/core
	bin/phpunit --configuration core/ingesting/tests/Unit/phpunit.xml --coverage-text


.PHONY: core-coverage
core-coverage: ## Collects Core code coverage from running unit tests with phpunit/phpunit
	mkdir -p .build/phpunit/core
	bin/phpunit --configuration core/ingesting/tests/Unit/phpunit.xml --coverage-html var/coverage/core

.PHONY: core-architecture-check
core-architecture-check:  ## Check Core code architecture roules with deptrac
	vendor/bin/deptrac analyse core/depfile-core.yaml --report-uncovered
	vendor/bin/deptrac analyse core/depfile-publicjob.yaml