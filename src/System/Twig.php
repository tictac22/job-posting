<?php 

namespace Core\System;


class Twig {
	protected $moduleName;

	function __construct(string $moduleName) {
		$this->moduleName = $moduleName;
	}

	public function render(string $path, array $variables):string  {
		$loader = new \Twig\Loader\FilesystemLoader('src/Modules/' . $this->moduleName . '/');
		$twig = new \Twig\Environment($loader);
		return $twig->render($path, $variables);
	}
	
}