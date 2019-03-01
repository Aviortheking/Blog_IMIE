<?php

namespace App;

use ReflectionClass;
use Composer\Autoload\ClassLoader;

class Controller {

	/**
	 * get content of controller
	 *
	 * @param String $route
	 * @param ClassLoader $loader
	 *
	 * @return String
	 */
	public function getContent(String $route, ClassLoader $loader) {
		$map = array_filter($loader->getClassMap(), function($var) {
			return strpos($var, "App\Controller\\") === 0;
		}, ARRAY_FILTER_USE_KEY);
		foreach ($map as $key => $t) {
			$loader->loadClass($key);
		}
		/** @var String $class */
		foreach (get_declared_classes() as $class) {
			if(is_subclass_of( $class, 'App\Controller')) {
				$r = new ReflectionClass($class);
				foreach ($r->getMethods() as $method) {
					preg_match_all('#@(.*?)\n#s', $method->getDocComment(), $annotations);
					/** @var String $annot */
					foreach ($annotations[1] as $annot) {
						/** @var String[] $arr */
						$arr = preg_split("/ /", $annot);
						if($arr[0] === "route") {
							if(preg_match($arr[1], $route)) {
								$instance = new $class();
								$function = ($method->getName());
								return $instance->$function();
							}
						}
					}
				}
			}
		}

	}
}
