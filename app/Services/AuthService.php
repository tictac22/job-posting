<?php 



namespace App\Services;

use App\Models\User;
use App\Traits\RequestHelper;

class AuthService {
	use RequestHelper;

	function __construct(private User $usersModel) {}

	function register(array $body)
	{	
		$convertedBody = $this->getRequiredFields($body,$this->usersModel->getFillable());
		return $this->usersModel::create($convertedBody);
	}
}