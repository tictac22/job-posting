<?php 


namespace App\Modules\Home;
use App\Modules\Home\Module as ModuleC;
use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Psr\Http\Message\ResponseInterface;
use App\Modules\User\Module as UserModule;

class Controller {
	public $twig;
	protected $user;
	protected ModuleC $model;
	function __construct() {
		$this->twig = new Twig();
		$this->user = new UserModule();
		$this->model = new ModuleC();
	}

	function home():ResponseInterface {
		$user = $this->user::getUser();
		$posts = $this->model->getArticles();
		foreach ($posts as $key => $post) {
			$tags = explode(',',$post['tags']);
			$post['tags'] = $tags;
			$posts[$key] = $post;
		}
		$result = $this->twig->render('index.twig', ['title' => 'Thrivetalk','user' => $user,'posts' => $posts]);
        return new HtmlResponse($result);
    }
}
