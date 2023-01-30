<?php 

namespace App\Http\Controllers;

use App\Services\PostsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class PostsContoller extends Controller {

	function __construct(private PostsService $postsService){}
	public function getOne(Request $request, $id) {
		$post = $this->postsService->getPost((int)$id);

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
}