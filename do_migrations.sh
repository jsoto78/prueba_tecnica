#!/usr/bin/env bash
php bin/console doctrine:database:create --no-interaction
php bin/console doctrine:database:create --no-interaction --env=test
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
php bin/console doctrine:schema:update --force --no-interaction
php bin/console doctrine:schema:update --force --no-interaction --env=test