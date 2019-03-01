<?php

namespace App\Tags;

use App\Tags\Tag;
use App\DB\Post;

//ce tag est juste la pour donner les possibilité de mon composant
/**
 * input <tag type="bold">test</tag>
 * result <span style="font-weight: bold">test</span>
 */
class Tags extends Tag {
	public function render() {
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getElement();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();
		//creation de la balise "span"
		$post = Post::get($_GET["post"]);
		/** @var \App\DB\Tag $tag */
		foreach ($post->getTags() as $tag) {
			$res = $doc->createElement("a");
			$res->setAttribute("href", "/search?tag=" . $tag->getId());
			$res->setAttribute("class", "tag");
			$text = $doc->createTextNode($tag->getName());
			$res->appendChild($text);
			$pok->parentNode->insertBefore($res, $pok);
		}
	}
}
