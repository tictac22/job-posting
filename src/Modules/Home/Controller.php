<?php 


namespace App\Modules\Home;
use App\Modules\Home\Module as ModuleC;
use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;
use App\Modules\User\Module as UserModule;
use Psr\Http\Message\ServerRequestInterface;

class Controller {
	public $twig;
	protected $user;
	protected ModuleC $model;
	function __construct() {
		$this->twig = new Twig();
		$this->user = new UserModule();
		$this->model = new ModuleC();
	}

	function home(ServerRequestInterface $request):ResponseInterface {
		$user = $this->user::getUser();

		$param = ($request->getQueryParams())['tag'] ?? '';
		$posts = $this->model->getArticles($param);
		$result = $this->twig->render('index.twig', ['title' => 'Thrivetalk','user' => $user,'posts' => $posts]);
        return new HtmlResponse($result);
    }
}
