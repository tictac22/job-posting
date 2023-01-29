<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class PostsContoller extends Controller {


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
		dd($validator);
	}
}