<?php 

declare(strict_types=1);

include_once('init.php');
require_once 'vendor/autoload.php';

session_start();
use Core\System\AuthMiddleware;

$uri = '/job-post';
$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;
header("Access-Control-Allow-Origin: *");

$router->map('GET', '/','App\Modules\Home\Controller::home');

$router->map('GET', '/create','App\Modules\Posts\Controller::create')->middleware(new AuthMiddleware);
$router->map('GET', '/manage','App\Modules\Posts\Controller::manage')->middleware(new AuthMiddleware);
$router->map('GET', '/job/{id:number}','App\Modules\Posts\Controller::getOne');
$router->map('POST', '/create','App\Modules\Posts\Controller::createPost');
$router->map('POST', '/delete-post/{id:number}','App\Modules\Posts\Controller::deletePost');

$router->map('GET', '/register','App\Modules\Auth\Controller::register');
$router->map('GET', '/signin','App\Modules\Auth\Controller::signin');

$router->map('POST', '/register','App\Modules\Auth\Controller::userRegister');
$router->map('POST', '/signin','App\Modules\Auth\Controller::userSignin');
$router->map('DELETE', '/delete','App\Modules\Auth\Controller::logout');

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

