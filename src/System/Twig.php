<?php 

namespace Core\System;


class Twig {

	public function render(string $path, array $variables):string  {
		$loader = new \Twig\Loader\FilesystemLoader('src/Views/');
		$twig = new \Twig\Environment($loader);
		return $twig->render($path, $variables);
	}
	
}