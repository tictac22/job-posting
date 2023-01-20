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
use App\Modules\User\Module as UserModule;

class Controller {

	protected $twig;
	protected $model;
	protected $user;
	function __construct() {
		$this->twig = new Twig();
		$this->model = new Model();
		$this->user = new UserModule();
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
		return $this->returnRedirect('/manage');
    }
	function userSignin(ServerRequestInterface $request):ResponseInterface {
		$response = new Response;
		try {
			ValidationC::validate($request->getParsedBody(),[
				'email'                 => 'required|email',
				'password'              => 'required|min:5',
			]);
		} catch (ExcBody $th) {
			$response->getBody()->write(json_encode($th->getErrors()));
			$response;
			return $response->withStatus(400);
			exit();
		}
		try {
			$this->model->login($request->getParsedBody());

		} catch (\Throwable $th) {
			$response->getBody()->write(json_encode(['email' => 'email or password are incorrect', 'password' => 'email or password are incorrect']));
			return $response->withStatus(400);
			exit();
		}
		$redirect = new RedirectResponse(BASE_URI . '/manage',302, [
			'Location' => BASE_URI . '/manage',
		]);
		header("Location:" . BASE_URI . '/manage');
		return $redirect;
    }
	function logout():ResponseInterface {
		$this->user::logout();

		return $this->returnRedirect('');
	}

	function returnRedirect($path = ''):ResponseInterface {
		$redirect = new RedirectResponse(BASE_URI . $path,302, [
			'Location' => BASE_URI . $path,
		]);
		header("Location:" . BASE_URI . $path);
		return $redirect;
	}
}
