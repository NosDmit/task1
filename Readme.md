## Juni 

### Описание:
https://gist.github.com/unit-cto/35df387e612502051371ebdd184db2ab

### Нужно выполнить

Команда для запуска:

`docker-compose up -d`

Установить зависимости:

`docker exec juni composer install`

Выполнить тесты:

`docker exec juni vendor/bin/phpunit`

Пример выполнения:

`docker exec juni php bin/console juni 'Hello, my name is {{name}}.' 'Hello, my name is Juni.'`
