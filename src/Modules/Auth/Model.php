<?php 



namespace App\Modules\Auth;

use Core\System\Db;
use Error;

class Model extends Db {


	function register(array $fields):int {
		$sql = "INSERT INTO users (name,password,email) VALUES(:name,:password,:email) ";
		$query = parent::$db->prepare($sql);
		$query->execute($fields);
		$query->fetch();
		$id =parent::$db->lastInsertId();
		$this->createToken($id);

		return $id;
	}
	function login($fields) {
		$sql = "SELECT * FROM users WHERE email =:email";
		$query = parent::$db->prepare($sql);
		$query->execute(['email' => $fields['email']]);
		$user = $query->fetch();
		if(!$user) throw new Error('error');
		
		$verify = password_verify($fields['password'],$user['password']);
		if(!$verify) throw new Error('error');

		$this->createToken($user['user_id']);
		return $user;
	}
	function createToken(int $id): string {
		$this->deleteTokens($id);

		$session = $this->generateToken($id);
		$sql = "INSERT INTO sessions (session,user_id) VALUES(:session,:user_id)";
		$query = parent::$db->prepare($sql);
		$query->execute(['user_id' =>$id,'session'=>$session]);

		$_SESSION['user_id'] = $id;
		return $session;
	}
	function deleteTokens(int $id) {
		$sql = "DELETE FROM sessions WHERE user_id = :user_id";
		$query = parent::$db->prepare($sql);
		$query->execute(['user_id' =>$id]);
	}
	protected function generateToken() {
		$bytes = random_bytes(128);
		return substr(bin2hex($bytes),0,243);
	}
	
}
