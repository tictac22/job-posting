<?php 


namespace App\Modules\Auth;


use App\Modules\Auth\Model;
use Core\System\Exceptions\ExcBody;
use Core\System\Twig;
use Core\System\Validation as ValidationC;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller {

	protected $twig;
	protected $model;
	function __construct() {
		$this->twig = new Twig();
		$this->model = new Model();
	}

	function register(ServerRequestInterface $request):ResponseInterface {
		$result = $this->twig->render('register.twig', ['title' => 'Register']);
        return new HtmlResponse($result);
    }
	function signin():ResponseInterface {
		$result = $this->twig->render('login.twig', ['title' => 'Signin']);
        return new HtmlResponse($result);
    }
	function userRegister(ServerRequestInterface $request):ResponseInterface {
		$response = new Response();
		$body = $request->getParsedBody();
		
		try {
			ValidationC::validate($body,[
				'name'                  => 'required|min:6',
				'email'                 => 'required|email|',
				'password'              => 'required|min:5',
				'confirm'      => 'required|same:password',
			]);
		} catch (ExcBody $th) {
			$response->getBody()->write(json_encode($th->getErrors()));
			$response;
			return $response->withStatus(400);
			exit();
		}
		unset($body['confirm']);
		$body['password'] = password_hash($body['password'],PASSWORD_BCRYPT);
		try {
			$data = $this->model->register($body);
		}
		catch (\Throwable $th) {
			$response->getBody()->write(json_encode(['email' => 'email is already taken']));
			return $response->withStatus(400);
		}
		try {
			$this->model->createToken($data);
		} catch (\Throwable $th) {
			$response->getBody()->write(json_encode(['email' => 'Error on server side']));
			return $response->withStatus(400);
		}
		$redirect = new RedirectResponse(BASE_URI . '/manage',302, [
			'Location' => BASE_URI . '/manage',
		]);
		header("Location:" . BASE_URI . '/manage');
		return $redirect;
    }
	function userSignin(ServerRequestInterface $request):ResponseInterface {
		$response = new Response;
		try {
			ValidationC::validate($request->getParsedBody(),[
				'email'                 => 'required|email|min:20',
				'password'              => 'required|min:20',
			]);
		} catch (ExcBody $th) {
			$response->getBody()->write(json_encode($th->getErrors()));
			$response;
			return $response->withStatus(400);
			exit();
		}

		$response->getBody()->write(json_encode($request->getParsedBody()));

		return $response;
    }
}