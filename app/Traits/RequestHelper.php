<?php 

namespace App\Traits;


trait RequestHelper {

	function getRequiredFields(array $body, array $modelFields):array {
		$reqiuredFieldsArray = [];

		foreach($modelFields as &$modelField) {
			$reqiuredFieldsArray[$modelField] = $body[$modelField] ?? '';
		}

		return $reqiuredFieldsArray;
	}
} 