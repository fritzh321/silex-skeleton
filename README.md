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


Execute this SQL in your database

        CREATE TABLE IF NOT EXISTS `t_users` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `username` varchar(255) NOT NULL DEFAULT '',
              `password` varchar(255) NOT NULL DEFAULT '',
              `first_name` varchar(255) NOT NULL,
              `last_name` varchar(255) NOT NULL,
              `enabled` int(1) NOT NULL DEFAULT '0',
              `roles` varchar(255) NOT NULL DEFAULT '',
              PRIMARY KEY (`id`),
              UNIQUE KEY `unique_username` (`username`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
This GIT is based on
* Jon Segador <info@jonsegador.com>
* CRUD Admin Generator webpage: [http://crud-admin-generator.com](http://crud-admin-generator.com)

Modified by:
* Fritz Hoste <hoste.fritz@gmail.com>

