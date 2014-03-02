<?php
require 'Slim/Slim.php';
require 'src/Rating.php';
require 'src/Misc.php';

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

$app->get('/about-us', function () use($app) {
    $app->render('about-us.php');
});

$app->get('/essential-info', function () use($app) {
    $app->render('essential-info.php');
});

$app->get('/rate-my-landlord', function () use($app) {
    $app->render('rate-my-landlord.php');
});

$app->get('/contact-us', function () use($app) {
    $app->render('contact-us.php');
});

$app->get('/view-ratings', function () use($app) {
    $ratings = Rating::getRatings();
    $app->view()->setData(array('ratings' => $ratings));
    $app->render('view-ratings.php');
});

$app->get('/rating/:id', function ($id) use ($app) {
    $ratings = Rating::getRatingByID($id);
    if (empty($ratings)) {
$res = new \Slim\Http\Response();
$res->setStatus(400);
$res->write('You made a bad request');
$res->headers->set('Content-Type', 'text/plain');

/**
 * Finalize
 * @return [
 *     200,
 *     ['Content-type' => 'text/plain'],
 *     'You made a bad request'
 * ]
 */
$res->isNotFound();
exit;
    } else {
        $app->view()->setData(array('ratings' => $ratings));
        $app->render('rating.php');
    }
});

$app->get('/search/:postcode', function ($postcode) use ($app) {
    $results = Rating::getSearchResults($postcode);
    $app->view()->setData(array('ratings' => $results));
    $app->render('search-results.php');
});

//old urls still on social media
$app->get('/civichack/view-ratings', function () use($app) {
    $ratings = Rating::getRatings();
    $app->view()->setData(array('ratings' => $ratings));
    $app->render('view-ratings.php');
});

$app->get('/civichack/rate-my-landlord', function () use($app) {
    $app->render('rate-my-landlord.php');
});

$app->run();
