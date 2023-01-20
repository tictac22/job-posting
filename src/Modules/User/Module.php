<?php

namespace App\Modules\User;

use Core\System\Db;

class Module extends Db {

	static function getUser() {
		$user_id =  $_SESSION['user_id'] ?? null;

		if(!$user_id) return [];
		$sql = "SELECT * FROM users where user_id = :user_id";
		$query = self::$db->prepare($sql);
		$query->execute(['user_id' => $user_id]);
		return $query->fetch();

	}
	static function logout() {
		$sql = "DELETE FROM sessions WHERE session = :session";
		$query = self::$db->prepare($sql);
		$query->execute(['session' =>  $_SESSION['token']]);
		unset($_COOKIE['token']);
		unset($_SESSION['token']);
		unset($_SESSION['user_id']);
		unset($_COOKIE['PHPSESSID']);
                setcookie('PHPSESSID', '', time() - 86400, BASE_URI);	
		session_destroy();
		setcookie('token', null, -1, BASE_URI);

		
	}	
}
