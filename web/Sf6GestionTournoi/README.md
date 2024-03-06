
symfony create-project symfony/skeleton
symfony server:start
symfony console doctrine:query:sql "create table test(nom varchar(10));"
symfony console doctrine:query:sql "insert into test values ('dupont');"
symfony composer req maker --dev
symfony console make:entity
//Next: When you're ready, create a migration with symfony console make:migration

sudo apt install sqlite3
composer require doctrine/doctrine-bundle
composer require symfony/orm-pack
touch /home/tony/M1/secondSemester/web/Sf6GestionTournoi/var/data.db
sudo apt-get install php-sqlite3
php bin/console doctrine:query:sql "create table essai (nom varchar(10));"
php bin/console doctrine:query:sql "select * from essai"
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:query:sql "SELECT name FROM sqlite_schema WHERE type ='table' AND name NOT LIKE 'sqlite_%';"
php bin/console doctrine:migrations:diff
symfony console make:controller
composer require symfony/twig-bundle
composer require symfony/form
php bin/console make:form