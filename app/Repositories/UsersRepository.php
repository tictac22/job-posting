<?php


namespace App\Repositories;

use App\Interfaces\UsersRepositoryInterface;
use App\Models\Users;

class UsersRepository implements UsersRepositoryInterface {


	function __construct(private Users $users) {}
	
	function getAll()
	{
		return $this->users::orderBy('username','desc')->limit(3)->get();
	}
}