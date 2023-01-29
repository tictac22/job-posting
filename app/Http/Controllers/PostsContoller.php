<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class PostsContoller extends Controller {


	public function create(Request $request)
	{
		$body = $request->all();
		//'company_name','job_title','location','tags','logo','description','user_id'
		$validator = Validator::make($body, [
            'company_name' => 'required|max:255|min:5',
            'job_title' => 'required|max:255|min:5',
			'location' => 'required|max:255|min:5',
			'tags' => 'required|max:255|min:5',
			'logo' => ['required',File::types(['jpg','png'])],
			'description' => 'required|max:255|min:10',
        ]);
		if($validator->fails()) {
			return response($validator->errors(),'400');
		}
		dd($validator);
	}
}