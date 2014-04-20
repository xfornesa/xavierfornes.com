<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

$app->get('/', function() use ($app) {
        return $app['twig']->render('Default/index.html.twig');
    })->bind('homepage');

$app->get('/the-bakery.html', function() use ($app) {
        return $app['twig']->render('Default/portfolio.html.twig');
    })->bind('bakery');

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
                $message = 'Disculpas, pero algo salió mal. Si se repite porqué no me mandas un email y me avisas por favor: xavier@prunatic.com';
        }
        return new Response( $app['twig']->render('Error/error.html.twig', array(
                'errorMessage' => $message
            )), $code);
    });

return $app;
