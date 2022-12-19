<?php 


namespace App\Modules\Home;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;

class Controller {
	public $twig;
	function __construct() {
		$this->twig = new Twig('Home');
	}

	function hello():ResponseInterface {
		$result = $this->twig->render('home.twig', ['title' => 'Home']);
        return new HtmlResponse($result);
    }
}
