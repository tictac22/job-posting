<?php 

namespace Core\System;

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Tag\ImageTag;
use Error;

Configuration::instance([
  'cloud' => [
    'cloud_name' => 'ddmcmjx3v', 
    'api_key' => '933261224396995', 
    'api_secret' => 'G3D4_xylAF5jiy8lRGFKs1keLPA'],
  'url' => [
    'secure' => true]]);


class File {

	protected UploadApi $uploadApi;

	function __construct() {
		$this->uploadApi = new UploadApi();
	}

	function upload($file) {
		try {
			return $this->uploadApi->upload($file['tmp_name'], [
			'public_id' => 'test' . $this->generateRandomString(),
			'upload_preset' => 'my_uploads',
			'use_filename' => TRUE,
			'overwrite' => TRUE]);
		} catch (\Throwable $th) {
			throw new Error($th->getMessage());
		}
	}
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
