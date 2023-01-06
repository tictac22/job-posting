<?php 


namespace Core\System;
use Core\System\Db;

use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware extends Db implements MiddlewareInterface {

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
	
}


