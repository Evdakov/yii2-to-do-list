<p align="center">
    <h1 align="left">Список задач</h1>
</p>

<h2>Начало работы:</h2>

Клонируем репозиторий в указанную папку
```
git clone https://github.com/Evdakov/yii2-to-do-list.git your_project_folder
```
<p>
    Устанавливаем composer, если его нет (инструкцию по установке можно посмотреть по ссылке)<br>
    https://getcomposer.org/download/
</p>

<p>
Переходим в папку проекта
</p>

Загружаем зависимости
```
composer update
```
<p>
    Создаем базу данных postgresql. По-умолчанию your_db_name. 
    Можно поменять название базы данных, доступы к ней в файле <br>
    \config\db.php
</p>

Выполняем миграции
```
yii migtare
```

Список задач доступен по адресу http://your_project_name/to-do