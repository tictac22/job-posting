<?php 

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
		$body = $request->all();
		$validator = Validator::make($body, [
            'name' => 'required|max:255|min:2',
			'lastname' => 'required|max:255|min:2',
            'email' => 'required|email:rfc,dns|unique:user',
            'password' => ['required',Password::min(2)->mixedCase(), 'confirmed'],
			'password_confirmation' => 'same:password'
        ]);
		if($validator->fails()) {
			return response($validator->errors(),'400');
		}

		$user = $this->usersService->register($body);
		Auth::login($user);
		return redirect('manage');
	}	
}