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
}