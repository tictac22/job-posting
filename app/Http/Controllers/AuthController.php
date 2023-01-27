<?php 

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller {

	/**
	 * 
	 * @return \Illuminate\View\View
	 */

	function __construct(private UsersService $usersService) {}
	public function register(Request $request)
	{	
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:users,username',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => ['required',Password::min(8)->mixedCase()->letters(), 'confirmed'],
			'password_confirmation' => 'same:password'
        ]);
		if($validator->fails()) {
			return response($validator->errors(),'400');
		}
		return response($request->all());
	}	
}