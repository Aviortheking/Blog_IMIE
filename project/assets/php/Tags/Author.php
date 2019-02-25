<?php

namespace App\Tags;

use App\Tags\Tag;

/**
 * input <tag type="author" column="(column name)"/>
 * return text
 */
class Author extends Tag {
	public function render() {

		$post = array( //testing purpose
			'name'=> "test",
			'image'=> "pokemon",
			'linkedin'=> "pouet"
		);



		$pok = $this->getElement();
		$attr = $pok->getAttribute("column");

		$doc = $this->getDoc();

		$txt = $doc->createTextNode($post[$attr]);

		$pok->parentNode->insertBefore($txt, $pok);
	}
}
