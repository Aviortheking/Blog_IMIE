<?php

namespace App\Tags;

use App\Tags\Tag;
use App\Functions;

/**
 * input <tag type="includes" file="(html file in includes folder)"/>
 * return the content of the file
 */
class Includes extends Tag {
	public function render() {
		$el = $this->getElement();
		$attr = $el->getAttribute("file");

		$p = file_get_contents("../html/includes/".$attr.".html");

		// var_dump($p);
		Functions::appendHTML($el->parentNode, $p);
	}
}
