<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Prunatic\Controller\MainController;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// setting up services
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.options'        => [
        'cache'            => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true
    ],
    'twig.path'           => [__DIR__ . '/../src/Prunatic/Resources/views']
]);

// Application services
$app[MainController::class] = $app->share(function () use ($app) {
    return new MainController($app);
});

// setting up controllers
$app->mount('/', $app[MainController::class]);

// error fallback
$app->error(function (\Exception $e) use ($app) {
    if ($app['debug']) {
        return;
    }

    $code = ($e instanceof HttpException) ? $e->getStatusCode() : 500;
    switch ($code) {
        case 404:
            $message = 'No se ha encontrado la página';
            break;
        default:
            $message = 'Disculpas, pero algo salió mal.' .
                        'Si se repite porqué no me mandas un email y me avisas por favor: xavier@prunatic.com';
    }
    return new Response( $app['twig']->render('Error/error.html.twig', ['errorMessage' => $message]), $code);
});

return $app;
