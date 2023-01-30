<?php 

namespace App\Services;

use App\Models\Posts;
use App\Traits\RequestHelper;
use Illuminate\Support\Facades\Auth;

class PostsService {
	use RequestHelper;

	function __construct(private Posts $postsModule, private FileService $fileService){}
	public function getPost(int $id)
	{
		$post =  $this->postsModule::findOrFail($id);
		$tags = explode(',',$post->tags);
		$post['tags'] = $tags;
		return $post;
	}
	public function createPost(array $body)
	{	
		$imageurl = $this->fileService->upload($body['logo']);

		$convertedBody = $this->getRequiredFields($body,$this->postsModule->getFillable());
		$convertedBody['logo'] = $imageurl;
		$convertedBody['user_id'] = Auth::id();
		
		return $this->postsModule::create($convertedBody);

	}
}