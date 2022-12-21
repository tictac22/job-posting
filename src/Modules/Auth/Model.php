<?php 



namespace App\Modules\Auth;

use Core\System\Db;

class Model extends Db {


	function register(array $fields):int {
		$sql = "INSERT INTO users (name,password,email) VALUES(:name,:password,:email) ";
		$query = parent::$db->prepare($sql);
		$query->execute($fields);
		$query->fetch();
		return parent::$db->lastInsertId();
	}

	function createToken(int $id): string {
		$session = $this->generateToken($id);
		$sql = "INSERT INTO sessions (session,user_id) VALUES(:session,:user_id)";
		$query = parent::$db->prepare($sql);
		$query->execute(['user_id' =>$id,'session'=>$session]);
		$query->fetch();

		$_SESSION['token'] = $session;
		$_SESSION['user_id'] = $$id;
		setcookie('token',$session,time() + 3600 * 24 * 30);
		return $session;
	}

	protected function generateToken() {
		$bytes = random_bytes(128);
		return substr(bin2hex($bytes),0,243);
	}
	
}