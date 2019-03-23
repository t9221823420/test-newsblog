#Test News Blog

## Задача:

Реализуйте на laravel простую новостную ленту с простым управлением содержимого.

Стек:
MySQL 5.7
Laravel 5.7
php 7.1

Требования:
На главной странице, расположенной на http://localhost:8000/ отображается список новостей отсортированный по дате и времени создания от новых к старым. С возможностью фильтрации по категории.
Заголовок новости ведёт на подробное описание новости (модальное окно или отдельная страница детальной новости)
Управление(создание, изменение, просмотр списка, удаление) списком новостей происходит со страницы http://localhost:8000/manager, обязательные поля к заполнению: Название(короткий текст), Текст(полный текст), Категория(короткий текст или выпадающий список).
Для клиентской части можно использовать Bootstrap

Основной упор задания узнать уровень и способность мыслить разработчика отталкиваясь от описанных требований.

Тестовое задание предполагает использование чистого фреймворка, без дополнительных расширений.

В принципе в рамках фреймворка можно пользоваться всем, что он предоставляет, если сторонний пакет жизненно необходим для разработки или тестового задания добавлять его допускается, однако не допускается использование инструментов не подходящих для задачи по причинам нецелесобразности - для примера использование пакетов реализующих административный интерфейс типо sleepingown или аналогичных, не допускается.

## Установка

## Использованы сторонние расширения

- **[Nayjest Grids](https://github.com/Nayjest/Grids)**
- **[Kris Form builder](https://github.com/kristijanhusak/laravel-form-builder)**

## Установка

необходимо выполнить следующую команду в окне терминала:

composer create-project yozh/test-newsblog:dev-master

после этого необходимо настроить файл .env в котором необходимо указать учетные данные для доступа к Базе Данных

после этого необходимо применить миграции командой:

php artisan migrate

запуск встроенного сервера осуществляется командой:

php artisan serve

управление контентом происходит на странице по ссылке:
Категории : /manager/category
Новости : /manager/news

после чего можно приступить к заполнению новостей

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
