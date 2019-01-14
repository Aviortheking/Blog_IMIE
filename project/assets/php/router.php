<?php
class Router {
	private static $router;

	public function __construct() {
		Router::$router = $this;
	}

	public static function getRouter() {
		return Router::$router;
	}

	private $routeList = array();

	public function addRoute($route, $page) {
		$this->routeList[$route] = $page;
	}

	public function dump() {
		return $this->routeList;
	}

	public function search($path) {
		foreach ($this->routeList as $reg => $page) {
			if(preg_match($reg, $path)) {
				return $page;
			}
		}
		return function() {return file_get_contents("../html/404.html");};
	}
}
