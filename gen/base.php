<?php


require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/app.php';



__BASE_INCLUDES__


$app->match('/', function () use ($app) {

    return $app['twig']->render('ag_dashboard.html.twig', array());
        
})
->bind('dashboard');


$app->run();