<?php 

namespace App\Services;
use Illuminate\Validation\Rules\File;

use App\Models\Posts;
use App\Traits\ParseTags;
use App\Traits\RequestHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsService {
	use RequestHelper;
	use ParseTags;
	function __construct(private Posts $postsModule, private FileService $fileService){}
	public function getAll()
	{
		$posts = $this->postsModule::query();
		$filters = request(['tag','search']);
		if(array_key_exists('tag',$filters)) {
			$posts->where('tags','LIKE','%'. strtolower($filters['tag']).'%');
		}
		$filteredPosts = $posts->get();
		foreach($filteredPosts as &$post) {

			$post['tags'] = $this->parseTags(strtolower($post->tags));
			
		}
		return $filteredPosts;
	}
	public function getPost(int $id)
	{
		$post =  $this->postsModule::findOrFail($id);
		return $post;
	}
	public function getUsersPosts(int $id)
	{
		return $this->postsModule::select('job_title','id')->where('user_id',$id)->get();
	}
	public function createPost(array $body)
	{	
		$imageurl = $this->fileService->upload($body['logo']);

		$convertedBody = $this->getRequiredFields($body,$this->postsModule->getFillable());
		$convertedBody['logo'] = $imageurl;
		$convertedBody['user_id'] = Auth::id();
		return $this->postsModule::create($convertedBody);

	}
	public function editPost(array $body)
	{	
		$post = $this->postsModule::find($body['postId']);
		if($body['isImage']) {
			$body['logo'] = $this->fileService->delete($post->logo,$body['logo']);
		}

		$convertedBody = $this->getRequiredFields($body,$this->postsModule->getFillable());
		$convertedBody['user_id'] = Auth::id();
		
		return $post->update($convertedBody);

	}
	
}