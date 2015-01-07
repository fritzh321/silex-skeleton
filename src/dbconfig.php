<?php 

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(

        'dbs.options' => array(
            'db' => array(
                'driver'   => 'pdo_mysql',
                'dbname'   => 'DB_NAME',
                'host'     => 'host',
                'user'     => 'user',
                'password' => 'PASS',
                'charset'  => 'utf8',
            ),
        )
));

