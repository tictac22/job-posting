<<<<<<< HEAD
<?php

namespace Core\System\Exceptions;

use Exception;

class ExcBody extends Exception{
	protected $errors;

	public function __construct(string $msg, array $errors){
		parent::__construct($msg);
		$this->errors = $errors;
	}

	public function getErrors(){
		return $this->errors;
	}
=======
<?php

namespace Core\System\Exceptions;

use Exception;

class ExcBody extends Exception{
	protected $errors;

	public function __construct(string $msg, array $errors){
		parent::__construct($msg);
		$this->errors = $errors;
	}

	public function getErrors(){
		return $this->errors;
	}
>>>>>>> 29515bdf7f64e917ea6ece536133c684b155a943
}