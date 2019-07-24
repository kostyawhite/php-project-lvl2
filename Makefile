install:
	composer install
lint:
	composer run-script phpcs -- --standard=PSR12 src bin
lint-fix:
	composer run-script phpcbf -- --standard=PSR12 src bin
test:
	# vendor/bin/phpunit tests
	composer run-script phpunit tests
