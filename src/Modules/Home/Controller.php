<?php 


namespace App\Modules\Home;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;

class Controller {
	public $twig;
	function __construct() {
		$this->twig = new Twig();
	}

	function home():ResponseInterface {
		$result = $this->twig->render('index.twig', ['title' => 'Thrivetalk']);
        return new HtmlResponse($result);
    }
}
