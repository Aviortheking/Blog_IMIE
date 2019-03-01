<?php

namespace App\Tags;

use App\Tags\Tag;
use App\Functions;
use App\DB\Post;

use DOMXPath;

/**
 * inputs <tag type="article" column="(voir les collones de la table post)/>
 * return text
 */
class Article extends Tag {
	public function render() {

		// $post = array( //testing purpose
		// 	'title'=> "test",
		// 	'url'=> "pokemongo",
		// 	'content'=> "<p>azerthjjhhdsqmlkjhgfd</p>"
		// );

		$post = Post::get($_GET["post"]);

		$pok = $this->getElement();
		$attr = $pok->getAttribute("column");

		$doc = $this->getDoc();

		if($attr == "content") {

			Functions::appendHTML($pok->parentNode, $post->getContent());
		} elseif($attr == "category") {
			$txt = $doc->createTextNode($post->getCategory()->getName());
			$pok->parentNode->insertBefore($txt, $pok);
		} else {
			$col = "get" . ucfirst($attr);
			$txt = $doc->createTextNode($post->$col());
			$pok->parentNode->insertBefore($txt, $pok);
		}

		$finder = new DomXPath($doc);
		$nodes = $finder->query("//*[contains(@class, 'column-cat')]");

		if(count($nodes) >= 1) $nodes[0]->setAttribute("class", str_replace("column-cat", $post->getCategory()->getName() , $nodes[0]->getAttribute("class")));

	}
}
