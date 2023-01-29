<?php 

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
class AuthController extends Controller {
	
	/**
	 * 
	 * @return \Illuminate\View\View
	 */

	function __construct(private AuthService $authService) {}

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
		$body['password'] = Hash::make($body['password'], [
			'rounds' => 12,	
		]);
		$user = $this->authService->register($body);
		Auth::login($user,$remember = true);
		return redirect('manage');
	}
	public function login(Request $request)
	{	
		$body = $request->all();

		$validator = Validator::make($body, [
            'email' => 'required|email:rfc,dns',
            'password' => ['required',Password::min(2)->mixedCase()],
        ]);
		if($validator->fails()) {
			return response($validator->errors(),'400');
		}
		if (Auth::attempt($validator->validated(),$remember = true)) {
            $request->session()->regenerate();
            return redirect('manage');
        }
		return response([
			'email' => 'email or password are incorrects'
		],'400');
	}
	public function logout(Request $request)
	{	
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect('/');
	} 
}