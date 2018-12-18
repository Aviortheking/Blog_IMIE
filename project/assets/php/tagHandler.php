<?php
/**
 * <tag type="pokemon" arg="pokemongo"><div class="pokemon-item"></div></tag>
 */


$debug = false;


class Tag {

	private $DOM;
	private $doc;
	private $debug;
	
	public function __construct(DOMDocument $doc, DOMElement $DOMContent, bool $debug) {
		$this->doc = $doc;
		$this->DOM = $DOMContent;
		$this->debug = $debug;
	}
	
	public function getDoc() {
		return $this->doc;
	}
	
	public function getDOM() {
		return $this->DOM;
	}

	public function isDebugging() {
		return $this->debug;
	}

	public function render() {}
}
//ce tag est juste la pour donner les possibilité de mon composant
//input <tag type="bold">test</tag>

//result <span style="font-weight: bold">test</span>
class Bold extends Tag {
	public function render() {
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getDOM();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();
		//creation de la balise "div"
		$res = $doc->createElement("span");
		//creation du texte et assignation du texte se trouvant dans la balise de base
		$text = $doc->createTextNode($pok->textContent);
		//on rajoute a notre balise div notre texte
		$res->appendChild($text);
		//on rajoute a la balise div du style pour le mettre en gras
		$res->setAttribute("style", "font-weight: bold");
		//on retourne la div

		//enfin on met la div final dans le fichier
		$pok->parentNode->insertBefore($res, $pok);
	}
}
//inputs <tag type="article" column="(voir les collones de la table post)
//return #text
class Article extends Tag {
	public function render() {

		$post = array( //testing purpose
			'title'=> "test",
			'url'=> "pokemon",
			'content'=> "<p>azerthjjhhdsqmlkjhgfd</p>"
		);



		$pok = $this->getDOM();
		$attr = $pok->getAttribute("column");
		
		$doc = $this->getDoc();

		$parent = $pok->parentNode;

		

		if($attr == "content") {
			appendHTML($pok->parentNode, $post[$attr]);
		} else {
			$txt = $doc->createTextNode($post[$attr]);
			$pok->parentNode->insertBefore($txt, $pok);
		}
	}
}

/**
 *  return element is user
 */
class IsLoggedIn extends Tag {
	public function render() {
		
		$el = $this->getDOM();

		//debugging purpose
		$loggedin = false;

		foreach ($el->getElementsByTagName("if") as $element) {
			if($element->hasAttribute("true") && $loggedin) {
				$r = $element->childNodes->item(1);
				$el->parentNode->insertBefore($r, $el);
			} elseif ($element->hasAttribute("false")) {
				$r = $element->childNodes->item(1);
				$el->parentNode->insertBefore($r, $el);
			}
		}
	}
}

class Author extends Tag {
	public function render() {

		$post = array( //testing purpose
			'name'=> "test",
			'image'=> "pokemon",
			'linkedin'=> "pouet"
		);



		$pok = $this->getDOM();
		$attr = $pok->getAttribute("column");
		
		$doc = $this->getDoc();

		$txt = $doc->createTextNode($post[$attr]);

		$pok->parentNode->insertBefore($txt, $pok);
	}
}

class Includes extends Tag {
	public function render() {
		$el = $this->getDOM();
		$doc = $this->getDoc();
		$attr = $el->getAttribute("file");
		$t = $doc->createDocumentFragment();
		// var_dump($attr);
		// var_dump(file_get_contents("../html/includes/".$attr.".html"));
		$p = file_get_contents("../html/includes/".$attr.".html");
		// var_dump($p);
		appendHTML($el->parentNode, $p);
		$el->setAttribute("style", $el->getAttribute("style"));
	}
}

class Svg extends Tag {
	public function render() {
		$el = $this->getDOM();
		$attr = $el->getAttribute("file");
		$t = $this->getDoc()->createDocumentFragment();
		$p = file_get_contents("../img/".$attr.".svg");
		appendHTML($el->parentNode, $p);
		$el->nextSibling->setAttribute("style", $el->getAttribute("style"));
	}
}

/**
 * input <tag type="loop" for="(table)" limit="(nombre-max généré)">
 */
class Loop extends Tag {
	public function render() {
		$el = $this->getDOM();

		$doc = $this->getDoc();

		$limit = (int) $el->getAttribute("limit");

		//testing purpose variable
		$posts = array(
			array(
				'title'=> "a",
				'url'=> "e",
				'content'=> "<p>i</p>",
				'date'=> "2018-09-20"
			),
			array(
				'title'=> "b",
				'url'=> "f",
				'content'=> "<p>j</p>",
				'date'=> "2018-09-21"
			),
			array(
				'title'=> "c",
				'url'=> "g",
				'content'=> "<p>k</p>",
				'date'=> "2018-09-22"
			),
			array(
				'title'=> "d",
				'url'=> "h",
				'content'=> "<p>l</p>",
				'date'=> "2018-09-23"
			),
			array(
				'title'=> "z",
				'url'=> "z",
				'content'=> "<p>z</p>",
				'date'=> "2018-10-23"
			),
		);

		//if($limit == 0) $limit = count($posts);
		
		$parent = $el->parentNode;
		//var_dump($parent);
		for ($i=0; $i < $limit; $i++) {
			//var_dump($i);
			$pok = $el->childNodes->item(1)->cloneNode(true);
			$parent->insertBefore($pok, $el);

			$elements = $pok->getElementsByTagName("loop");

			foreach ($elements as $ele) {
				if($ele->getAttribute("column") == "content") {
					appendHTML($ele, $posts[$i][$ele->getAttribute("column")]);
				} else {
					$txt = $doc->createTextNode($posts[$i][$ele->getAttribute("column")]);
					$ele->parentNode->insertBefore($txt, $ele);
				}
			}
		}

		$loop = $parent->getElementsByTagName("loop");

		while ($loop->length >= 1 && !$this->isDebugging()) {
			$loop[0]->parentNode->removeChild($loop[0]);
		}
	}
}

function appendHTML(DOMNode $parent, $source) {
	$tmpDoc = new DOMDocument();
	$html = "<html><body>";
	$html .= $source;
	$html .= "</body></html>";
	$tmpDoc->loadHTML($html);
	foreach ($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
		$importedNode = $parent->ownerDocument->importNode($node, true);
		$parent->appendChild($importedNode);
	}
}

//testing purpose
//$content = file_get_contents("./test.html");

function loadTags($ctnt, $debug) {
	$dom = new DOMDocument();
	libxml_use_internal_errors(true);
	$dom->loadHTMLFile($ctnt);
	libxml_clear_errors();

	$list = $dom->getElementsByTagName("tag");

	$head = $dom->getElementsByTagName("head");
	$t = $dom->createDocumentFragment();
	$p = file_get_contents("../html/includes/head.html");
	$t->appendXML($p);
	$head->item(0)->appendChild($t);
	
	//remove all tag components
	while($list->length >= 1) {
		
		$lst = $list->item(0);
		$tgs = ucfirst($lst->getAttribute("type"));
		// var_dump($tgs);
		$tg =  new $tgs($dom, $lst, $debug);

		$tg->render();
		
				$list[0]->parentNode->removeChild($list[0]);

		$list = $dom->getElementsByTagName("tag");
	}
	$res = $dom->saveHTML();
	
	return $res;
}
