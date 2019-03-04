<?php

namespace App\Tags;

use DomXPath;

class Element extends Tag {
	public function render() {
		$el = $this->getElement();
		$term = isset($_GET["term"]) ? $_GET["term"] : "";
		if($el->hasAttribute("el")) $el->parentNode->insertBefore($this->getDoc()->createTextNode($term), $el);
		else {
			$finder = new DomXPath($this->getDoc());
			$nodes = $finder->query("//*[contains(@class, 'el-search')]");
			if(count($nodes) >= 1) $nodes[0]->setAttribute("value", $term);
		}
	}
}
