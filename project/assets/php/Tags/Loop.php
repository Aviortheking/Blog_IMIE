<?php

namespace App\Tags;

use App\Tags\Tag;
use DomXPath;
use App\Functions;
use App\DB\Post;

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

		$posts = Post::list($limit);

		$pdo = Functions::connect();
		$query = $pdo->query("SELECT title, categories.name as categorie, dt as date, short as content
		FROM posts
		INNER JOIN categories ON categories.id=posts.categorie
		ORDER BY date DESC
		LIMIT 6;");
		$posts = $query->fetchAll();

		$parent = $el->parentNode;
		//var_dump($parent);


		$limit = $limit > count($posts) ? count($posts) : $limit;

		for ($i=0; $i < $limit; $i++) {
			$pok = $el->childNodes->item(0)->cloneNode(true);

			$parent->insertBefore($pok, $el);

			$elements = $pok->getElementsByTagName("loop");

			foreach ($elements as $ele) {
				if($ele->getAttribute("column") == "content") {
					Functions::appendHTML($ele->parentNode, $posts[$i]["content"]);
				} else {
					$txt = $doc->createTextNode($posts[$i][$ele->getAttribute("column")]);
					$ele->parentNode->insertBefore($txt, $ele);
				}
			}

			$finder = new DomXPath($doc);
			$nodes = $finder->query("//*[contains(@class, 'column-cat')]");

			if(count($nodes) >= 1) $nodes[0]->setAttribute("class", str_replace("column-categorie", $posts[$i]["categorie"], $nodes[0]->getAttribute("class")));

			$loop = $pok->getElementsByTagName("loop");

			while ($loop->count() >= 1) {
				$loop->item(0)->parentNode->removeChild($loop->item(0));
			}


		}
	}
}
