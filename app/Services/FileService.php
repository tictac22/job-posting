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
	function delete(string $url,$file)
	{	
		$dividedPath = explode('/', $url);
		$pathWithoutExt = explode('.', $dividedPath[count($dividedPath)-1]);
		cloudinary()->destroy($pathWithoutExt[0]);
		return $this->upload($file);
	}
}