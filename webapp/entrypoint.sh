composer install
yarn install
yarn build &
php bin/console doctrine:schema:create
php bin/console server:run 0.0.0.0:80
