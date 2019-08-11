# ВипСервис. Тестовое задание 

## Порядок запуска
1. Склонировать репозиторий
   ```bash
   git clone git@github.com:deusmax88/vip-service-exchange-rates-test-task.git .
   ```
1. Стартовать сервисы с использованием утилиты docker-compose
    ```bash
    docker-compose up -d
    ```
1. После инициализации сервиса mariadb произвести создание 
таблицы из файла exchange-rate-table.sql
1. Открыть в браузере localhost/

## Пояснения к решению
Код, решающий задачу выполнен в качестве модуля ExchangeRate, расположен в папке
```shell script
module/ExchangeRage
```