<?php

namespace App\Tags;

use App\Tags\Tag;

//ce tag est juste la pour donner les possibilité de mon composant
/**
 * input <tag type="bold">test</tag>
 * result <span style="font-weight: bold">test</span>
 */
class Bold extends Tag {
	public function render() {
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getElement();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();
		//creation de la balise "span"
		$res = $doc->createElement("span");
		//creation du texte et assignation du texte se trouvant dans la balise de base
		$text = $doc->createTextNode($pok->textContent);
		//rajout dans la balise span notre texte
		$res->appendChild($text);
		//on rajoute a la balise span du style pour le mettre en gras
		$res->setAttribute("style", "font-weight: bold");
		//enfin on met la div final dans le fichier
		$pok->parentNode->insertBefore($res, $pok);
	}
}
