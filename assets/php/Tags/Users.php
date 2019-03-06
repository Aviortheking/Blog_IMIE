<?php

namespace App\Tags;

use App\DB\Author;


class Users extends Tag {
	public function render() {
		$el = $this->getElement();
		$doc = $this->getDoc();
		$parent = $el->parentNode;
		foreach (Author::list(true, 1000) as $user) {
			$pok = $el->childNodes->item(0)->cloneNode(true);
			$pok->setAttribute("onclick", "window.location = window.location + '" . $user->getId() . "/edit/'");

			$parent->insertBefore($pok, $el);

			$elements = $pok->getElementsByTagName("loop");

			foreach ($elements as $ele) {
				$col = 'get' . ucfirst($ele->getAttribute("column"));
				$txt = $doc->createTextNode($user->$col());
				$ele->parentNode->insertBefore($txt, $ele);
			}

			$loop = $pok->getElementsByTagName("loop");

			while ($loop->count() >= 1) {
				$loop->item(0)->parentNode->removeChild($loop->item(0));
			}


		}

	}
}
