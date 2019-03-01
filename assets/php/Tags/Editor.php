<?php

namespace App\Tags;

use App\DB\Category;
use DateTime;
use App\DB\Tag;


class Editor extends \App\Tags\Tag {
	public function render() {
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getElement();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();

		$type = $pok->getAttribute("element");

		switch ($type) {
			case 'categories':
				$option = $doc->createElement("option");
				$text = $doc->createTextNode("Categorie");
				$option->setAttribute("value", "-1");
				$option->setAttribute("disabled", "true");
				$option->setAttribute("selected", "selected");
				$option->appendChild($text);
				$pok->parentNode->insertBefore($option, $pok);
				foreach (Category::list() as $cat) {
					$option = $doc->createElement("option");
					$text = $doc->createTextNode($cat->getName());
					$option->appendChild($text);
					$option->setAttribute("value", $cat->getId());
					$pok->parentNode->insertBefore($option, $pok);
				}
				break;
			case 'datetime':
				$dt = new DateTime();
				$pok->parentNode->insertBefore($doc->createTextNode($dt->format('d/m/Y H:i:s')), $pok);
				break;
			case 'content':
				$tarea = $doc->createElement("textarea");
				$tarea->setAttribute("style", "width: 100%; min-height: 200px");
				$pok->parentNode->insertBefore($tarea, $pok);
				break;
			case 'title':
				$input = $doc->createElement("input");
				$input->setAttribute("style", "width: 100%");
				$input->setAttribute("placeholder", "titre");
				$pok->parentNode->insertBefore($input, $pok);
				break;
			case 'tags':
				foreach (Tag::list() as $el) {
					$tg = $doc->createElement("input");
					$tg->setAttribute("id", $el->getId());
					$tg->setAttribute("type", "checkbox");
					$txt = $doc->createElement("label");
					$txt->appendChild($doc->createTextNode($el->getName()));
					$txt->setAttribute("for", $el->getId());
					$pok->parentNode->insertBefore($tg, $pok);
					$pok->parentNode->insertBefore($txt, $pok);
				}
				$btn = $doc->createElement("button");
				$btn->appendChild($doc->createTextNode("Add Tag"));
				$btn->setAttribute("class", "addTag");
				$pok->parentNode->insertBefore($btn, $pok);
			default:
				# code...
				break;
		}
	}
}
