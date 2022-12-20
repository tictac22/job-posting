<?php 


namespace App\Modules\Auth;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

use Rakit\Validation\Validator;

class Controller {

	public $twig;
	function __construct() {
		$this->twig = new Twig();
	}

	function register():ResponseInterface {
		$result = $this->twig->render('register.twig', ['title' => 'Register']);
		
		

        return new HtmlResponse($result);
    }
	function signin():ResponseInterface {
		$result = $this->twig->render('login.twig', ['title' => 'Signin']);
        return new HtmlResponse($result);
    }

	function userRegister(ServerRequestInterface $request):ResponseInterface {
		$response = new Response;

		$validator = new Validator;
		$validation = $validator->make($request->getParsedBody(), [
		'name'                  => 'required|min:20',
		'email'                 => 'required|email|min:20',
		'password'              => 'required|min:20',
		'confirm'      => 'required|same:password|min:20',
		]);
		$validation->validate();
		if ($validation->fails()) {
			$errors = $validation->errors();
			$response->getBody()->write(json_encode($errors->firstOfAll()));
			$response;
			return $response->withStatus(400);
			exit();
		}
		$response->getBody()->write(json_encode($request->getParsedBody()));
		return $response;
    }
	function userSignin(ServerRequestInterface $request):ResponseInterface {
		$response = new Response;
		$validator = new Validator;
		$validation = $validator->make($request->getParsedBody(), [
		'email'                 => 'required|email|min:20',
		'password'              => 'required|min:20',
		]);
		$validation->validate();
		if ($validation->fails()) {
			$errors = $validation->errors();
			$response->getBody()->write(json_encode($errors->firstOfAll()));
			$response;
			return $response->withStatus(400);
			exit();
		}

		$response->getBody()->write(json_encode($request->getParsedBody()));

		return $response;
    }
	
}