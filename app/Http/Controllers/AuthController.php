<?php 

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;
class AuthController extends Controller {

	/**
	 * 
	 * @return \Illuminate\View\View
	 */

	function __construct(private UsersService $usersService) {}
	
	public function register(Request $request) 
	{	
		$users = $this->usersService->register();
		dd($request);
		return view('auth.register');
	}	
}