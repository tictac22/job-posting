<?php 


namespace App\Modules\Posts;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rakit\Validation\Validator;

class Controller {
	public $twig;
	function __construct() {
		$this->twig = new Twig();
	}
	function getOne():ResponseInterface {
		$result = $this->twig->render('job.twig', ['title' => 'Create']);
        return new HtmlResponse($result);
    }
	function create():ResponseInterface {
		$result = $this->twig->render('create.twig', ['title' => 'Create']);

		

        return new HtmlResponse($result);
    }
	function manage():ResponseInterface {
		$result = $this->twig->render('manage.twig', ['title' => 'Listings']);
        return new HtmlResponse($result);
    }
	function createPost(ServerRequestInterface $request):ResponseInterface {
		$response = new Response;

		$validator = new Validator;
		$validation = $validator->make($request->getParsedBody() + $_FILES, [
		'name'                 => 'required|email|min:20',
		'title'                 => 'required|email|min:20',
		'decsr'                 => 'required|email|min:20',
		'tags'                 => 'required|email|min:20',
		'image'                 => 'required|uploaded_file:0,500K,png,jpeg',
		'location'                 => 'required|email|min:20',
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
		//print_r($_FILES);
		return $response;
    }
}
