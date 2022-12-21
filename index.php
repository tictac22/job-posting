<?php 

declare(strict_types=1);

use Core\System\DB;
use Core\System\AuthMiddleware;

include_once('init.php');
require_once 'vendor/autoload.php';

$auth = new AuthMiddleware();

$token =  $_SESSION['token'] ?? $_COOKIE['token'] ?? null;
$user = null;
if($token) {
	$user = $auth->getUserById($token);
}

$uri = '/job-post';
$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));


$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;
header("Access-Control-Allow-Origin: *");

$router->map('GET', '/','App\Modules\Home\Controller::home');

$router->map('GET', '/create','App\Modules\Posts\Controller::create');
$router->map('GET', '/manage','App\Modules\Posts\Controller::manage')->middleware($auth);
$router->map('GET', '/job/{id:number}','App\Modules\Posts\Controller::getOne');
$router->map('POST', '/create','App\Modules\Posts\Controller::createPost');


$router->map('GET', '/register','App\Modules\Auth\Controller::register');
$router->map('GET', '/signin','App\Modules\Auth\Controller::signin');

$router->map('POST', '/register','App\Modules\Auth\Controller::userRegister');
$router->map('POST', '/signin','App\Modules\Auth\Controller::userSignin');

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);

