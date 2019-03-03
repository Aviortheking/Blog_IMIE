<?php

namespace App\Tags;

class User extends Tag {
	public function render() {
		$el = $this->getElement();
		if(isset($_SESSION["author"])) $el->parentNode->insertBefore($this->getDoc()->createTextNode($_SESSION["author"]->getId()), $el);
	}
}
