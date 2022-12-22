<?php 


namespace App\Modules\Home;

use Core\System\Db;

class Module  extends Db{


	function getArticles() {
		$sql = "SELECT * FROM posts";
		$query = parent::$db->prepare($sql);
		$query->execute();
		$posts =  $query->fetchAll();

		foreach ($posts as $key => $post) {
			$tags = explode(',',$post['tags']);
			$post['tags'] = $tags;
			$posts[$key] = $post;
		}

		return $posts;
	}

}