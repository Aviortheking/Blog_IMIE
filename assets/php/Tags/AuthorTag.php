<?php

namespace App\Tags;

use App\Tags\Tag;
use App\DB\Post;

/**
 * input <tag type="author" column="(column name)"/>
 * return text
 */
class AuthorTag extends Tag {
	public function render() {

		$author = Post::get($_GET["post"])->getAuthor();



		$pok = $this->getElement();
		$attr = $pok->getAttribute("column");

		$doc = $this->getDoc();

		$col = "get" . ucfirst($attr);

		$txt = $doc->createTextNode($author->$col());

		$pok->parentNode->insertBefore($txt, $pok);
	}
}
