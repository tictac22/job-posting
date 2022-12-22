<?php 


namespace App\Modules\Posts;
use App\Modules\Posts\Module as PostModel;

use Laminas\Diactoros\Response\HtmlResponse;
use Core\System\Twig;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rakit\Validation\Validator;
use App\Modules\User\Module as UserModule;

use Core\System\Exceptions\ExcBody;
use Core\System\Validation as ValidationC;
use Core\System\File;
use Laminas\Diactoros\Response\RedirectResponse;

class Controller {
	public $twig;
	protected $user;
	protected File $file;
	protected PostModel $model;
	function __construct() {
		$this->user = new UserModule();
		$this->twig = new Twig();
		$this->file = new File();
		$this->model = new PostModel();
	}
	function getOne(ServerRequestInterface $request):ResponseInterface {
		$query = ($request->getQueryParams())['querysystemurl'];
		$id = (int)substr($query,4);
		$user = $this->user::getUser();
		$post = $this->model->getOne($id);
		$result = $this->twig->render('job.twig', ['title' => 'Create','user' => $user,'post' => $post]);
        return new HtmlResponse($result);
    }
	function create():ResponseInterface {
		$user = $this->user::getUser();
		$result = $this->twig->render('create.twig', ['title' => 'Create','user' => $user]);

		return new HtmlResponse($result);
    }
	function manage():ResponseInterface {
		$user = $this->user::getUser();
		$posts = $this->model->getAll();
	
		$result = $this->twig->render('manage.twig', ['title' => 'Listings','user' =>$user, 'posts' => $posts]);
        return new HtmlResponse($result);
    }
	function deletePost(ServerRequestInterface $request):ResponseInterface {
		$query = ($request->getQueryParams())['querysystemurl'];
		$id = (int)substr($query,12);
		$this->model->deletePost($id);

		$redirect = new RedirectResponse(BASE_URI . '/manage' ,302, [
			'Location' => BASE_URI . '/manage',
		]);
		header("Location:" . BASE_URI . '/manage');
		return $redirect;
	}
	function createPost(ServerRequestInterface $request):ResponseInterface {
		$response = new Response;

		$body = $request->getParsedBody();

		
		try {
			ValidationC::validate($body + $_FILES, [
				'name'                 => 'required|min:5',
				'title'                 => 'required|min:5',
				'decsr'                 => 'required|min:5',
				'tags'                 => 'required|min:5',
				'location'                 => 'required||min:5',
	
			]);
		} catch ( ExcBody $th) {
			$response->getBody()->write(json_encode($th->getErrors()));
			$response;
			return $response->withStatus(400);
			exit();
		}

		try {
			
			$file = $this->file->upload($_FILES['image']);
			$imageUrl = $file['secure_url'];
			$body['image'] = $imageUrl;
			$post_id = $this->model->createPost($body);
		} catch (\Throwable $th) {
			echo $th->getMessage();
			$response->getBody()->write(json_encode($body));
			return $response->withStatus(400);
		}

		$redirect = new RedirectResponse(BASE_URI . '/' . 'job/' . $post_id,302, [
			'Location' => BASE_URI . '/' . 'job/' . $post_id,
		]);
		header("Location:" . BASE_URI . '/' .  'job/' . $post_id);
		return $redirect;

    }
}
