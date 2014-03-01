<?php
require 'Slim/Slim.php';
require 'src/Rating.php';

\Slim\Slim::registerAutoloader();

use RateMyLandlord\Rating;

$app = new \Slim\Slim(array(
        'debug' => true
));

$app->hook('slim.before', function () use ($app) {
    $posIndex = strpos( $_SERVER['PHP_SELF'], '/index.php');
    $baseUrl = substr( $_SERVER['PHP_SELF'], 0, $posIndex);
    $app->view()->appendData(array('baseUrl' => $baseUrl . '/' ));
});

$app->get('/', function () use($app) {
    $app->render('index.php');
});

$app->get('/rate-my-landlord', function () use($app) {
    $app->render('rate-my-landlord.php');
});

$app->get('/view-ratings', function () use($app) {
    $ratings = Rating::getRatings();
    $app->view()->setData(array('ratings' => $ratings));
    $app->render('view-ratings.php');
});

$app->get('/hello/:name', function ($name) use ($app) {
    $app->view()->setData(array('name' => $name));
    $app->render('hello.php');
});

$app->run();
