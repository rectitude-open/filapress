#!/bin/bash
set -e

php artisan test --parallel
/home/wwwroot/filapress/vendor/bin/pint
/home/wwwroot/filapress/vendor/bin/phpstan analyse
