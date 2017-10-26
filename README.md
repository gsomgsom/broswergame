### Начальная настройка папок ###
В проекте необходимы папки с доступом 0777
/protected/runtime/
/assets/assets/
/assets/upload/

### Настройка Бвзы Данных ###
Коннект к базе указывается в файле 
/protected/config/custom_db.sql (файл игнорируется системой контроля версий)

Если файл не найден, то коннект берётся из основного файла
/protected/config/db.sql

### Настройка миграций ###
Для создания собственных миграций можно воспользоваться yiic 
Подробнее о механизме миграций:
http://www.yiiframework.com/doc/guide/1.1/en/database.migration#creating-migrations

Кроме того в проекте используется консольная команда yiic database
Например, чтобы сдампить схему в миграцию, достаточно выполнить команду
./yiic database dump db_schema --insertData=0

Чтобы сдампить только данные:
./yiic database dump db_data --createSchema=0

Миграции с этой консольной командой попадут в /runtime/, дальше их можно допилить руками (дописать метод safeDown(), обрезать префиксы к таблицам)