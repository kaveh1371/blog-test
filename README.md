to initiating project:
make .env file based on .env.example file 

commands:
composer install
php artisan key:generate
php artisan migrate
php artisan create:fake-users
php artisan create:fake-posts
