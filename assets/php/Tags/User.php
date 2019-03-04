<?php

namespace App\Tags;

class User extends Tag {
	public function render() {
		$el = $this->getElement();
		if(isset($_SESSION["author"])) {
			$col = $el->getAttribute("column");
			$func = "get" . ucfirst($col);
			$el->parentNode->insertBefore($this->getDoc()->createTextNode($_SESSION["author"]->$func()), $el);
		}
	}
}
