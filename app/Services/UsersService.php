<?php 



namespace App\Services;

use App\Models\Users;
use App\Traits\RequestHelper;

class UsersService {
	use RequestHelper;

	function __construct(private Users $usersModel) {}

	function register(array $body)
	{	
		$convertedBody = $this->getRequiredFields($body,$this->usersModel->getFillable());
		return $this->usersModel::create($convertedBody);
	}
}