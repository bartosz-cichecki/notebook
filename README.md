# Init project

- `docker-compose build`
- `docker-compose up -d`
- `docker-compose exec php zsh`
- `composer install`
- `bin/console doctrine:database:create`
- `bin/console doctrine:migrations:migrate`
- `bin/console doctrine:database:create --env=test`
- `bin/console doctrine:migrations:migrate --env=test`

# Run behats:
- `docker-compose exec php zsh`
- `vendor/bin/behat`
