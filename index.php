<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
        'debug' => true
));

$app->get('/', function () use($app) {
    $app->render('index.php');
});
$app->get('/hello/:name', function ($name) use ($app) {
    $app->view()->setData(array('name' => $name));
    $app->render('hello.php');
});

$app->run();
