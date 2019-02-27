<?php

namespace App\Tags;

use App\Tags\Tag;
use App\Functions;

/**
 * <tag type="svg" style="color: white; width: 18px; height: 18px""/>
 */
class Svg extends Tag {
	public function render() {
		$el = $this->getElement();
		$attr = $el->getAttribute("file");
		$t = $this->getDoc()->createDocumentFragment();
		$p = file_get_contents("../img/".$attr.".svg");
		Functions::appendHTML($el->parentNode, $p);
		$el->nextSibling->setAttribute("style", $el->getAttribute("style"));
	}
}
