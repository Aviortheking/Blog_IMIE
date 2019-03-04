<?php

namespace App\Tags;

use App\Tags\Tag;
use App\DB\Post;
use App\DB\Tag as AppTag;

class Tags extends Tag {
	public function render() {

		$pok = $this->getElement();

		$doc = $this->getDoc();

		$tags = isset($_GET["post"]) ? Post::get($_GET["post"])->getTags() : AppTag::list();
		/** @var \App\DB\Tag $tag */
		foreach ($tags as $tag) {
			$res = $doc->createElement("a");
			$url = "?tag=" . $tag->getId();
			if(isset($_GET["term"])) $url .= "&term=" . $_GET["term"];
			if(isset($_GET["category"])) $url .= "&category=" . $_GET["category"];
			$res->setAttribute("href", "/search/" . $url);
			$classes = "tag";
			if(isset($_GET["tag"]) && $tag->getId() == $_GET["tag"]) $classes .= " active";
			$res->setAttribute("class", $classes);
			$text = $doc->createTextNode($tag->getName());
			$res->appendChild($text);
			$pok->parentNode->insertBefore($res, $pok);
		}
	}
}
