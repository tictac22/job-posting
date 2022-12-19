<?php 


namespace App\Modules\Auth;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;


class Controller {


	function signUp(ServerRequestInterface  $request): ResponseInterface {
	
		print_r($_FILES);
		$response = new Response;

		$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

			$response->getBody()->write(json_encode($_POST));
			return $response;
	}
}