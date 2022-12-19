<?php 


namespace App\Modules\Home;


use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;

class Controller {
	public $twig;
	function __construct() {
		$this->twig = new Twig('Home');
	}

	function hello():ResponseInterface {
		$result = $this->twig->render('View.twig', ['name' => 'Fabien']);
        return new HtmlResponse($result);
    }
}
