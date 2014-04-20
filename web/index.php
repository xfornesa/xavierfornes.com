<?php

umask(0000);
ini_set('display_errors', 0);

/** @var \Silex\Application $app */
$app = require_once __DIR__ . '/../src/app.php';
require __DIR__.'/../config/prod.php';

$app->run();
