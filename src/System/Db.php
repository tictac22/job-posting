<<<<<<< HEAD
<?php 

namespace Core\System;

use PDO;

class DB {
	protected static $db;

	function __construct() {
		
		self::$db = new PDO(DB_URL,DB_NAME,DB_PASSWORD,[
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			
		]);
		self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	}
	
=======
<?php 

namespace Core\System;

use PDO;

class DB {
	protected static $db;

	function __construct() {
		
		self::$db = new PDO(DB_URL,DB_NAME,DB_PASSWORD,[
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			
		]);
		self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	}
	
>>>>>>> 29515bdf7f64e917ea6ece536133c684b155a943
}