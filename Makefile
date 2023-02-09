install:
	composer install

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src
	composer exec --verbose phpstan -- --level=8 --xdebug analyse src tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src

test:
	composer exec --verbose phpunit tests