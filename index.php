<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
        'debug' => true
));

$app->get('/', function () use($app) {
    $app->render('index.php');
});

$app->get('/rate-may-landlord', function () use($app) {
    $app->render('rate-may-landlord');
});

$app->get('/view-ratings', function () use($app) {
    $app->render('view-ratings.php');
});

$app->get('/hello/:name', function ($name) use ($app) {
    $app->view()->setData(array('name' => $name));
    $app->render('hello.php');
});

$app->run();