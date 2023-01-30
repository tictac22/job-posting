<?php 

namespace App\Traits;

trait ParseTags {

	function parseTags($tags)
	{
		$tags = explode(',',$tags);
		return $tags;
	}
}