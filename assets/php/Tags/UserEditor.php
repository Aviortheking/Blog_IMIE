<?php

namespace App\Tags;

use App\DB\Category;
use DateTime;
use App\DB\Tag;
use App\DB\Post;
use App\DB\Author;


class UserEditor extends \App\Tags\Tag {
	public function render() {
		$user = Author::get($_GET["edit_user"]);
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$el = $this->getElement();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();

		$type = $el->getAttribute("element");

		switch ($type) {
			case 'role':
				foreach (array("Utilisateur" => "ROLE_USER", "Editeur" =>"ROLE_EDITOR", "Admin" => "ROLE_ADMIN") as $key => $value) {
					$opt = $doc->createElement("option");
					$opt->setAttribute("value", $value);
					if($user->getRole() == $value) $opt->setAttribute("selected", "selected");
					$opt->appendChild($doc->createTextNode($key));
					$el->parentNode->appendChild($opt);
				}
				break;
			case 'username':
				$input = $doc->createElement("input");
				$input->setAttribute("value", $user->getUsername());
				$input->setAttribute("name", "username");
				$input->setAttribute("placeholder", "Nom d'utilisateur");
				$el->parentNode->insertBefore($input, $el);
				break;
			case 'linkedin':
				$input = $doc->createElement("input");
				$input->setAttribute("value", $user->getLinkedin());
				$input->setAttribute("name", "linkedin");
				$input->setAttribute("placeholder", "https://www.linkedin.com/in/ton_nom_dutilisateur/");
				$el->parentNode->insertBefore($input, $el);
				break;
			case 'job':
				$input = $doc->createElement("input");
				$input->setAttribute("value", $user->getJob());
				$input->setAttribute("name", "job");
				$input->setAttribute("placeholder", "Job");
				$el->parentNode->insertBefore($input, $el);
				break;
			default:
				# code...
				break;
		}

	}
}
