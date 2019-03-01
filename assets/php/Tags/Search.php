<?php

namespace App\Tags;

use App\Tags\Tag;
use App\DB\Post;

class Search extends Tag {

	public function render() {
		$isRecent = isset($_GET["recent"]) && $_GET["recent"] == "false" ? false : true;
		$category = isset($_GET["category"]) && intval($_GET["category"]) ? (int) $_GET["category"] : -1;
		$tag = isset($_GET["tag"]) && intval($_GET["tag"]) ? (int) $_GET["tag"] : -1;

		if($category != -1) {
			$posts = Post::listByCategory($category, $isRecent, 20);
		} else {
			$posts = Post::list($isRecent, 10);
		}
		if($tag != -1) {
			$tposts = array();
			foreach ($posts as $post) {
				foreach ($post->getTags() as $ptag) {
					if($tag == $ptag->getId()) {
						$tposts[] = $post;
					}
				}
			}
			$posts = $tposts;
		}

		var_dump($posts);

	}
}

class Loop extends Tag {
	public function render() {
		$el = $this->getElement();

		$doc = $this->getDoc();

		$limit = (int) $el->getAttribute("limit");
		$parent = $el->parentNode;

		$isRecent = isset($_GET["recent"]) && $_GET["recent"] == "false" ? false : true;
		$category = isset($_GET["category"]) && intval($_GET["category"]) ? (int) $_GET["category"] : -1;
		$tag = isset($_GET["tag"]) && intval($_GET["tag"]) ? (int) $_GET["tag"] : -1;

		if($el->getAttribute("category") != '') {
			$posts = Post::listByCategory(Post::get($_GET["post"])->getCategory()->getId(), $isRecent, 6);
			$postsList = array();
			foreach ($posts as $post) {
				if($post->getId() != $_GET["post"]) $postsList[] = $post;
			}
			$posts = $postsList;
		} else {
			$posts = Post::list(true, 6);

		}

		if($category != -1) {
			$posts = Post::listByCategory($category, $isRecent, 20);
		} else {
			$posts = Post::list($isRecent, 10);
		}
		if($tag != -1) {
			$tposts = array();
			foreach ($posts as $post) {
				foreach ($post->getTags() as $ptag) {
					if($tag == $ptag->getId()) {
						$tposts[] = $post;
					}
				}
			}
			$posts = $tposts;
		}


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
