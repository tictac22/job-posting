<?php 

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\PostsService;
use App\Traits\ParseTags;
use App\Traits\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;
class PostsContoller extends Controller {
	use Url;
	use ParseTags;
	function __construct(private PostsService $postsService,private FileService $fileService){}

	public function index(Request $request)
	{	
		$filters = request(['tag','search']);
		$hasParams = false;
		if(count($filters) > 0) {
			$hasParams = true;
		}
		$posts = $this->postsService->getAll($filters);
		return view('index',['posts'=> $posts,'hasParams' => $hasParams]);
	}
	public function getPostForm(Request $request, $id)
	{
		$post = $this->postsService->getPost((int)$id);
		if (!Gate::allows('update-post', $post)) {
			return redirect("/job/" . $id);
		}
		return view('edit',['post' => $post]);
	}
	public function getOne(Request $request, $id) 
	{
		$post = $this->postsService->getPost((int)$id);
		$post['tags'] = $this->parseTags($post->tags);
		$creator = false;
		if (Gate::allows('update-post', $post)) {
			$creator = true;
		}
		$post['updated_at_parse'] = Carbon::parse($post->updated_at)->format('d/m/Y');
		return view('job',['post' => $post,'creator' => $creator]);
	}

	public function getUsersPost(Request $request)
	{	
		$posts = $this->postsService->getUsersPosts((int)Auth::id());
		return view('manage',['posts' => $posts]);
	}

	public function create(Request $request)
	{
		$body = $request->all();
		$validator = Validator::make($body, [
            'company_name' => 'required|max:255|min:5',
            'job_title' => 'required|max:255|min:5',
			'location' => 'required|max:255|min:5',
			'tags' => 'required|max:255|min:5',
			'logo' => ['required',File::types(['jpg','png','jpeg'])->max(12 * 1024),],
			'description' => 'required|max:255|min:10',
        ],[
			'logo.max' => "image should be less than 12mb"
		]);

		if($validator->fails()) {
			return response($validator->errors(),'400');
		}
		$post = $this->postsService->createPost($body);
		return redirect('/job/'. $post['id']);
	}
	public function edit(Request $request)
	{
		$body = $request->all();
		$validator = Validator::make($body, [
			'company_name' => 'required|max:255|min:5',
            'job_title' => 'required|max:255|min:5',
			'location' => 'required|max:255|min:5',
			'postId' => 'required|numeric',
			'tags' => 'required|max:255|min:5',
			'logo' => ['required'],
			'description' => 'required|max:255|min:10',
        ],[
			'logo.max' => "image should be less than 12mb"
		]);
		if($validator->fails()) {
			return response($validator->errors(),'400');
		}

		$image = $body['logo'];

		$isImage = Validator::make(['logo' => $image],[
			'logo' => File::types(['jpg','png','jpeg'])->max(12 * 1024),
		]);
		if(!$this->validUrl($image) && $isImage->fails()) {
			return response($isImage->errors(),'400');
		}

		$body['isImage'] = false;
		if($isImage->valid()){
			$body['isImage'] = true;
		}

		$this->postsService->editPost($body);
		return redirect('/job/'. $body['postId']);

	}
}