<?php


class queryData {
    public $start;
    public $recordsTotal;
    public $recordsFiltered;
    public $data;

    function queryData() {
    }
}
 
use Silex\Application;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


$app = new Application();


$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());

require_once 'dbconfig.php';
require_once 'security.php';

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../web/views',
));


$app->before(function (Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $token = $app['security']->getToken();
    $app['user'] = null;

    if ($token && !$app['security.trust_resolver']->isAnonymous($token)) {
        $app['user'] = $token->getUser();
    }
});

$app->before(function() use ($app) {
    if ($app['request']->get('require_authentication')) {   
        if (null === $user = $app['session']->get('user')) {
            throw new AccessDeniedHttpException("require auth...");
        }
    }
});

$app->error(function (\Exception $e) use ($app) {
    if ($e instanceof AccessDeniedHttpException) {
        return $app->redirect('/accessdenied');
    }
});

$app->error(function(\Exception $e) use ($app) {
    if ($e instanceof NotFoundHttpException) {
        return $app['twig']->render('not_found.html.twig', array(
        "code" =>  $e->getStatusCode(),
        "error" => Response::$statusTexts[$e->getStatusCode()],
        "page" =>  $app['request']->getRequestUri()
        ));
    }
});






$app['asset_path'] = 'http://crud.dev/web/resources';
$app['debug'] = true;

return $app;
