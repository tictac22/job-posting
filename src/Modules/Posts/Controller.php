<?php 


namespace App\Modules\Posts;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;

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
}
