<?php 


namespace Core\System;


use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware extends DB implements MiddlewareInterface {

	function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface{
		$token =  $request->getCookieParams('token') ?? null;
		if ($token) {
			return $handler->handle($request);
		}

		$redirect = new RedirectResponse(BASE_URI . '/register',302, [
			'Location' => BASE_URI . '/register',
		]);
		return $redirect;
	}
	function getUserById(string $session) {
		$sql = "SELECT sessions.*,u.name, u.email FROM `sessions` JOIN users u USING(user_id) WHERE SESSION = :session";
		$query = self::$db->prepare($sql);
		$query->execute(['session' => $session]);
		return $query->fetch();

	}
}


