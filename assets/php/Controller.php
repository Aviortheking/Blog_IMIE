<?php

namespace App;

use ReflectionClass;

class Controller {

	public function getContent(String $route, $loader) {
		$map = array_filter(CLASSMAP, function($var) {
			return strpos($var, "App\Controller\\") === 0;
		}, ARRAY_FILTER_USE_KEY);
		foreach ($map as $key => $t) {
			$loader->loadClass($key);
		}
		foreach (get_declared_classes() as $class) {
			if(is_subclass_of( $class, 'App\Controller')) {
				$r = new ReflectionClass($class);
				foreach ($r->getMethods() as $method) {
					preg_match_all('#@(.*?)\n#s', $method->getDocComment(), $annotations);
					foreach ($annotations[1] as $annot) {
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
