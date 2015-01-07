<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '-1');


require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../src/app.php';

use Symfony\Component\HttpFoundation\Request;


$app->get($app['login_path'], function(Request $request) use ($app) {

	return $app['twig']->render('ag_login.html.twig', array(
		'error'         => $app['security.last_error']($request),
		'last_username' => $app['session']->get('_security.last_username'),
		));
});

$app->match('/accessdenied', function () use ($app) { 
	return $app['twig']->render('access_denied.html.twig', array());
})
->bind('accessdenied');


$app->match('/admin', function () use ($app) {

    return $app['twig']->render('ag_dashboard.html.twig', array());
        
})
->bind('admin');



$app->match('/', function () use ($app) {

    return $app['twig']->render('index.html.twig', array());
        
})
->bind('index');


$app->run();