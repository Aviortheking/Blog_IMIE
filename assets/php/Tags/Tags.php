<?php

namespace App\Tags;

use App\Tags\Tag;
use App\DB\Post;

class Tags extends Tag {
	public function render() {

		$pok = $this->getElement();

		$doc = $this->getDoc();

		$post = Post::get($_GET["post"]);
		/** @var \App\DB\Tag $tag */
		foreach ($post->getTags() as $tag) {
			$res = $doc->createElement("a");
			$res->setAttribute("href", "/search/?tag=" . $tag->getId());
			$res->setAttribute("class", "tag");
			$text = $doc->createTextNode($tag->getName());
			$res->appendChild($text);
			$pok->parentNode->insertBefore($res, $pok);
		}
	}
}
