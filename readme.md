Arinos CRM

Made from PHP<br>
Framework used: LARAVEL ver 5.4

<br>
http://laravel.jp/
<br>
https://laravel.com/
<br>
Instruction to install

1. Git clone from arinos github --> https://github.com/Arinos/arinos_crm
2. Download composer --> https://getcomposer.org/download/
3. Run 'composer install'
4. Enable /public and /storage folder for writing
5. Create and enable /public/excel/duplicate_data folder
6. Create /.env file (you may copy contents from '/.env.example' file and replace values inside)
7. Run 'php artisan key:generate'
8. Run 'php artisan config:clear'
9. Create Database, DB username, DB password (declared on your .env file)
10. Run 'php artisan migrate' (this will create the tables on your created Database)
