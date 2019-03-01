<?php

namespace App\Tags;

use App\Tags\Tag;
use DomXPath;
use App\Functions;
use App\DB\Post;
use App\DB\Category;

/**
 * input
 * <tag type="loop" for="(table)" limit="(nombre-max g�n�r�)">
 * <loop column="element"/>
 * </tag>
 */
class Loop extends Tag {
	public function render() {
		$el = $this->getElement();

		$doc = $this->getDoc();

		$limit = (int) $el->getAttribute("limit");

		if($el->getAttribute("category") !== null) {
			$posts = Post::listByCategory(Post::get($_GET["post"])->getCategory()->getId(), true, 6);
			$postsList = array();
			foreach ($posts as $post) {
				if($post->getId() != $_GET["post"]) $postsList[] = $post;
			}
			$posts = $postsList;
		} else {
			$posts = Post::list(true, 6);

		}


		$parent = $el->parentNode;
		//var_dump($parent);


		$limit = $limit > count($posts) ? count($posts) : $limit;

		for ($i=0; $i < $limit; $i++) {
			$pok = $el->childNodes->item(0)->cloneNode(true);

			$parent->insertBefore($pok, $el);

			$elements = $pok->getElementsByTagName("loop");

			foreach ($elements as $ele) {
				if($ele->getAttribute("column") == "content") {
					Functions::appendHTML($ele->parentNode, $posts[$i]->getShort());
				} elseif($ele->getAttribute("column") == "category") {
					$txt = $doc->createTextNode($posts[$i]->getCategory()->getName());
					$ele->parentNode->insertBefore($txt, $ele);
				} else {
					$col = 'get' . ucfirst($ele->getAttribute("column"));
					$txt = $doc->createTextNode($posts[$i]->$col());
					$ele->parentNode->insertBefore($txt, $ele);
				}
			}

			$finder = new DomXPath($doc);
			$nodes = $finder->query("//*[contains(@class, 'column-cat')]");

			if(count($nodes) >= 1) $nodes[0]->setAttribute("class", str_replace("column-category", $posts[$i]->getCategory()->getName() , $nodes[0]->getAttribute("class")));

			$nodes = $finder->query("//*[contains(@class, 'column-link')]");

			if(count($nodes) >= 1) $nodes[0]->setAttribute("href", "/post/".$posts[$i]->getId());
			if(count($nodes) >= 1) $nodes[0]->setAttribute("class", str_replace("column-link", "", $nodes[0]->getAttribute("class")));


			$loop = $pok->getElementsByTagName("loop");

			while ($loop->count() >= 1) {
				$loop->item(0)->parentNode->removeChild($loop->item(0));
			}


		}
	}
}
