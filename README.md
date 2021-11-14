YiiNetwork
============================

Социальная сеть на Yii2

Установка
---------

Чтобы запускать контейнеры от имени текущего пользователя, создайте файл `.env` в директории `<application-root>/docker` и определите переменные среды:

> UID=1000 <br/>
> GID=1000

По умолчанию используется значения `UID=1000` и `GID=1000`.

* Чтобы собрать и поднять контейнеры запустите команду в директории `<application-root>/docker`:

> docker-compose -p yiinetwork up --build -d

* Чтобы установить зависимости php запустите команду:

> docker exec -it yiinetwork_php_1 composer install

* Чтобы применить миграции базы данных запустите команду:

> docker exec -it yiinetwork_php_1 php yii migrate