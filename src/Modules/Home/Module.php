<?php 


namespace App\Modules\Home;

use Core\System\Db;

class Module  extends Db{


	function getArticles(string $tag) {
		if($tag) {
			$sql = 'SELECT * FROM `posts` WHERE MATCH(title,tags) AGAINST(:tag)';
			$fields = ['tag'  => $tag];
		} else {
			$sql = "SELECT * FROM posts";
			$fields = [];
		}
		$query = parent::$db->prepare($sql);
		$query->execute($fields);
		$posts =  $query->fetchAll();

		foreach ($posts as $key => $post) {
			$tags = explode(',',$post['tags']);
			$post['tags'] = $tags;
			$posts[$key] = $post;
		}

		return $posts;
	}

}