## Juni 

### Нужно выполнить

Команда для запуска:

`docker-compose up -d`

Установить зависимости:

`docker exec juni composer install`

Выполнить тесты:

`docker exec juni bin/phpunit`

Пример выполнения:

`docker exec juni php bin/console juni 'Hello, my name is {{name}}.' 'Hello, my name is Juni.'`