<?php 

namespace App\Services;

class FileService {

	function upload($file) {

		$uploadedFileUrl = cloudinary()->upload($file->getRealPath(),[
			"transformation" => [
				'quality' => 'auto',
				'fetch_format' => 'auto'
			]
		])->getSecurePath();
		return $uploadedFileUrl;
	}
}