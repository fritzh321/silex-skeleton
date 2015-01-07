<?php 

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(

        'dbs.options' => array(
            'db' => array(
                'driver'   => 'pdo_mysql',
                'dbname'   => 'admin_silex',
                'host'     => '185.18.148.35',
                'user'     => 'admin_silexad',
                'password' => 'UDve3YeSRB',
                'charset'  => 'utf8',
            ),
        )
));

