Silex Skeleton
===================

What is Silex Skeleton
-----------------------------

Silex Skeleton is a tool to **generate a complete backend from a MySql database** (based on schemamanager) where you can create, read, update and delete records in a database. 

**The backend is generated in seconds** without configuration files where there is a lot of *"magic"* and is very difficult to adapt to your needs. 

Login System included

It has been programmed with the Silex framework, so the resulting code is PHP.



Installation
------------

Clone the repository

    git clone hhttps://github.com/FritzH321/silex-skeleton.git silex-skeleton

    cd silex-skeleton

Download composer:

    curl -sS https://getcomposer.org/installer | php

Install vendors:

    php composer.phar install

You need point the document root of your virtual host to /path_to/admingenerator/web
    
You can customize the url using the .htaccess file, maybe this will help you:
[http://stackoverflow.com/questions/24952846/how-do-i-remove-the-web-from-my-url/24953439#24953439](http://stackoverflow.com/questions/24952846/how-do-i-remove-the-web-from-my-url/24953439#24953439)


Generate CRUD backend
---------------------

Edit the file /path_to/admingenerator/src/app.php and set your database conection data:

    $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
        'dbs.options' => array(
            'db' => array(
                'driver'   => 'pdo_mysql',
                'dbname'   => 'DATABASE_NAME',
                'host'     => 'localhost',
                'user'     => 'DATABASE_USER',
                'password' => 'DATABASE_PASS',
                'charset'  => 'utf8',
            ),
        )
    ));


You need to set the url of the resources folder.

Change this line:

    $app['asset_path'] = '/resources';

For the url of your project, for example:

    $app['asset_path'] = 'http://domain.com/crudadmin/resources';


Now, execute the command that will generate the CRUD backend:

    php console generate:admin

**This is it!** Now access with your favorite web browser.


The command generates one menu section for each database table. 


Author
------
This GIT is forked from 
* Jon Segador <info@jonsegador.com>
* CRUD Admin Generator webpage: [http://crud-admin-generator.com](http://crud-admin-generator.com)

Modified by:
* Fritz Hoste <hoste.fritz@gmail.com>

