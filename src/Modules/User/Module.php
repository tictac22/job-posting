<?php

namespace App\Modules\User;

use Core\System\Db;

class Module extends Db {

	static function getUser() {
		$token =  $_SESSION['token'] ?? $_COOKIE['token'] ?? null;
		if(!$token) return [];
		$sql = "SELECT sessions.*,u.name, u.email FROM `sessions` JOIN users u USING(user_id) WHERE SESSION = :session";
		$query = self::$db->prepare($sql);
		$query->execute(['session' => $token]);
		return $query->fetch();

	}
	static function logout() {
		$sql = "DELETE FROM sessions WHERE session = :session";
		$query = self::$db->prepare($sql);
		$query->execute(['session' =>  $_COOKIE['token']]);

		unset($_COOKIE['token']);
		setcookie('token', null, -1, BASE_URI);
	}	
}