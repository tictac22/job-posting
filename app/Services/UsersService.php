<?php 



namespace App\Services;

use App\Interfaces\UsersRepositoryInterface;
use App\Repositories\UsersRepository;

class UsersService {


	function __construct(private UsersRepository $usersRepository) {}

	function register()
	{
		return $this->usersRepository->getAll();
	}
}