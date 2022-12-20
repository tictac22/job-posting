<?php 


namespace App\Modules\Auth;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;


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
}