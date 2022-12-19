<?php 

declare(strict_types=1);
include_once('init.php');
require_once 'vendor/autoload.php';

$uri = '/job-post';
$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));



$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$router->map('GET', '/','App\Modules\Home\Controller::hello');
$router->map('POST', '/signup','App\Modules\Auth\Controller::signUp');
$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

