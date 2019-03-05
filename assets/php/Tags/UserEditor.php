<?php

namespace App\Tags;

use App\DB\Category;
use DateTime;
use App\DB\Tag;
use App\DB\Post;


class UserEditor extends \App\Tags\Tag {
	public function render() {
		if($_GET["post"] == "new") $_GET["post"] = null;
		elseif(isset($_GET["post"])) $post = Post::get($_GET["post"]);
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getElement();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();

		$type = $pok->getAttribute("element");

		switch ($type) {
			case 'role':
				foreach (array("Utilisateur" => "ROLE_USER", "Editeur" =>"ROLE_EDITOR", "Admin" => "ROLE_ADMIN") as $key => $value) {
					$opt = $doc->createElement("option");
					$opt->setAttribute("value", $value);
					$opt->appendChild($doc->createTextNode($key));
					$el->parentNode->appendChild();
				}
				$option = $doc->createElement("option");
				$text = $doc->createTextNode("Categorie");
				$option->setAttribute("value", "1");
				$option->setAttribute("disabled", "true");
				if(!isset($post)) $option->setAttribute("selected", "selected");
				$option->appendChild($text);
				$pok->parentNode->insertBefore($option, $pok);
				foreach (Category::list() as $cat) {
					$option = $doc->createElement("option");
					$text = $doc->createTextNode($cat->getName());
					$option->appendChild($text);
					$option->setAttribute("value", $cat->getId());
					if(isset($post) && $post->getCategory()->getId() == $cat->getId()) $option->setAttribute("selected", "selected");
					$pok->parentNode->insertBefore($option, $pok);
				}
				break;
			case 'datetime':
				if(isset($post)) $txt = $post->getDateTime();
				else $txt = (new DateTime())->format('d/m/Y H:i:s');
				$pok->parentNode->insertBefore($doc->createTextNode($txt), $pok);
				break;
			case 'content':
				$tarea = $doc->createElement("textarea");
				if(isset($post)) $tarea->appendChild($doc->createTextNode($post->getContent()));
				$tarea->setAttribute("style", "width: 100%; min-height: 200px");
				$pok->parentNode->insertBefore($tarea, $pok);
				break;
			case 'title':
				$input = $doc->createElement("input");
				$input->setAttribute("style", "width: 100%");
				$input->setAttribute("placeholder", "titre");
				if(isset($post)) $input->setAttribute("value", $post->getTitle());
				$pok->parentNode->insertBefore($input, $pok);
				break;
			case 'tags':
				foreach (Tag::list() as $el) {
					$tg = $doc->createElement("input");
					$tg->setAttribute("id", $el->getId());
					$tg->setAttribute("type", "checkbox");
					$tg->setAttribute("data-text", $el->getName());
					if(isset($post)) {
						if(in_array($el, $post->getTags())) $tg->setAttribute("checked", "checked");
					}
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
