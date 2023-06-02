# Documents Archive 

## Requirements 
    PHP 8.1+ 
    Laravel 10+ 
    composer 2.2+

## Configure 
    open your terminal and run these commands : 

    `cd documents-archives`
    `cp .env.example .env`

    use any text editor you familiar with to edit the ".env" file 

    `nano .env`

    configure database connection at this section :

    ``
    DB_HOST= mysql
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ``    
    change storage disk to public 

    `FILESYSTEM_DISK=public`

    save your changes , back to your terminal and run : 
    
    `nano config/app.php`

    find "timezone" and change it to your locale

    `'timezone' => 'Africa/Cairo',`

    save your changes , back to your terminal and run these commands : 

    `composer installl`
    `php artisain key:generate`
    `php artisain migrate:fresh`

    `php artisain db:seed`
    `php storage:link`

    ## test application
    
    `php artisain serv ` 

    it will run live server @ localhost:8000 








    