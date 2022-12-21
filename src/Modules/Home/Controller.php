<?php 


namespace App\Modules\Home;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;
use App\Modules\User\Module as UserModule;

class Controller {
	public $twig;
	protected $user;
	function __construct() {
		$this->twig = new Twig();
		$this->user = new UserModule();
	}

	function home():ResponseInterface {
		$user = $this->user::getUser();
		$result = $this->twig->render('index.twig', ['title' => 'Thrivetalk','user' => $user]);
        return new HtmlResponse($result);
    }
}
