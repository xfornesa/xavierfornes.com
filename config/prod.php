<?php

// configure your app for the production environment

// Locale
$app['locale'] = 'es';

// debug
$app['debug'] = false;

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Twig cache
$app['twig.options.cache'] = $app['cache.path'] . '/twig';
