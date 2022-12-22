<?php

namespace App\Modules\Posts;

use Core\System\DB;
use App\Modules\User\Module as UserModel;
class Module extends Db {

	protected UserModel $user;
	function __construct() {
		$this->user = new UserModel();
	}

	function getOne(int $id) {
		
		$sql = "SELECT * FROM posts WHERE post_id =:post_id";
		$query = parent::$db->prepare($sql);
		$query->execute(['post_id' => $id]);

		$post  =  $query->fetch();
		$tags = explode(',',$post['tags']);
		$post['tags'] = $tags;

		return $post;
	}

	function createPost(array $fields) {
		$user = $this->user->getUser();

		$fields['user_id'] = $user['user_id'];
		
		$sql = "INSERT INTO posts (user_id, company_name, title, decsr, tags, image, location) VALUES (:user_id,:name,:title,:decsr,:tags,:image,:location)";
		$query = parent::$db->prepare($sql);
		$query->execute($fields);
		$query->fetch();
		return parent::$db->lastInsertId();
	}
}