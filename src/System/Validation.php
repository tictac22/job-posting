<<<<<<< HEAD
<?php 

namespace Core\System;

use Core\System\Exceptions\ExcBody;

use Rakit\Validation\Validator;


class Validation {

	static function validate(mixed $body,array $rules) {
		$validator = new Validator;
		$validation = $validator->make($body, $rules);
		$validation->validate();
		if ($validation->fails()) {
			$errors = $validation->errors();
			throw new ExcBody('invalid body',$errors->firstOfAll());
		}
	}
=======
<?php 

namespace Core\System;

use Core\System\Exceptions\ExcBody;

use Rakit\Validation\Validator;


class Validation {

	static function validate(mixed $body,array $rules) {
		$validator = new Validator;
		$validation = $validator->make($body, $rules);
		$validation->validate();
		if ($validation->fails()) {
			$errors = $validation->errors();
			throw new ExcBody('invalid body',$errors->firstOfAll());
		}
	}
>>>>>>> 29515bdf7f64e917ea6ece536133c684b155a943
}