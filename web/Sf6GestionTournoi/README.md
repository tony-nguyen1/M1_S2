
symfony create-project symfony/skeleton
symfony server:start
symfony console doctrine:query:sql "create table test(nom varchar(10));"
symfony console doctrine:query:sql "insert into test values ('dupont');"
symfony composer req maker --dev
symfony console make:entity
//Next: When you're ready, create a migration with symfony console make:migration