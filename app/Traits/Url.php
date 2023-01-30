<?php 

namespace App\Traits;

trait Url {

	function validUrl(string $url): bool {
		$regEx = '/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/';
		return preg_match($regEx,$url);
	}
} 