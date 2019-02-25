<?php

namespace App\Tags;

use App\Tags\Tag;
use App\Functions;

/**
 * inputs <tag type="article" column="(voir les collones de la table post)/>
 * return text
 */
class Article extends Tag {
	public function render() {

		$post = array( //testing purpose
			'title'=> "test",
			'url'=> "pokemongo",
			'content'=> "<p>azerthjjhhdsqmlkjhgfd</p>"
		);

		$pok = $this->getElement();
		$attr = $pok->getAttribute("column");

		$doc = $this->getDoc();

		if($attr == "content") {
			Functions::appendHTML($pok->parentNode, $post[$attr]);
		} else {
			$txt = $doc->createTextNode($post[$attr]);
			$pok->parentNode->insertBefore($txt, $pok);
		}
	}
}
