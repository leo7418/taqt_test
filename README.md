Start the server          **php -S 127.0.0.1:8000 -t public/**
Create the db             **php bin/console doctrine:database:create**
Generate the migration    **php bin/console make:migration**
Execute the migration     **php bin/console doctrine:migrations:migrate**
