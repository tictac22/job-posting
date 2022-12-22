<?php 


namespace App\Modules\Home;

use Core\System\Db;

class Module  extends Db{


	function getArticles() {
		$sql = "SELECT * FROM posts";
		$query = parent::$db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

}