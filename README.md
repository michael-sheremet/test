# Test
Starting step: 
 - Clone repository `git clone git@github.com:michael-sheremet/test.git`
 - run `docker-compose up`
 - Enter into container `docker-compose exec app bash`
 - run `composer install`
 - run `php artisan migrate:install`
 - run `php artisan migrate`
 - run `php artisan db:seed`
 - run `php artisan jwt:secret`

In repository, you can find insomnia.json this is insomnia collection for manual test, please don't forget use Bearer token when you run auth request.

When you run all commands you can use test user for test:

| email          | password             
|----------------|:-------------:
| test@test.com  | 12345678
