<?php

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
/**
 * input <tag type="bold">test</tag>
 * result <span style="font-weight: bold">test</span>
 */
class Bold extends Tag {
	public function render() {
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getDOM();
		//recuperation du document (necessaire a la cr�ation de balises
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
/**
 * inputs <tag type="article" column="(voir les collones de la table post)/>
 * return text
 */
class Article extends Tag {
	public function render() {

		$post = array( //testing purpose
			'title'=> "test",
			'url'=> "pokemongo",
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
 * input
 * <tag type="isloggedin">
 *     <if true>
 *
 *     </if>
 *     <if false>
 *
 *     </if>
 * </tag>
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

/**
 * input <tag type="author" column="(column name)"/>
 * return text
 */
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

/**
 * input <tag type="includes" file="(html file in includes folder)"/>
 * return the content of the file
 */
class Includes extends Tag {
	public function render() {
		$el = $this->getDOM();
		$attr = $el->getAttribute("file");

		$p = file_get_contents("../html/includes/".$attr.".html");

		// var_dump($p);
		appendHTML($el->parentNode, $p);
	}
}

/**
 *  input <tag type="svg" style="color: white; width: 18px; height: 18px""/>
 */
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
 * input
 * <tag type="loop" for="(table)" limit="(nombre-max g�n�r�)">
 * <loop column="element"/>
 * </tag>
 * return something
 */
class Loop extends Tag {
	public function render() {
		$el = $this->getDOM();

		$doc = $this->getDoc();

		$limit = (int) $el->getAttribute("limit");

		require_once 'functions.php';

		$pdo = connect();
		$query = $pdo->query("SELECT title, categories.name as categorie, dt as date, short as content
		FROM posts
		INNER JOIN categories ON categories.id=posts.categorie
		ORDER BY date DESC
		LIMIT 6;");
		$posts = $query->fetchAll();

		$parent = $el->parentNode;
		//var_dump($parent);


		$limit = $limit > sizeof($posts) ? sizeof($posts) : $limit;

		for ($i=0; $i < $limit; $i++) {
			//var_dump($i);
			$pok = $el->childNodes->item(0)->cloneNode(true);

			$parent->insertBefore($pok, $el);

			$elements = $pok->getElementsByTagName("loop");

			foreach ($elements as $ele) {
				if($ele->getAttribute("column") == "content") {
					appendHTML($ele->parentNode, $posts[$i]["content"]);
				} else {
					$txt = $doc->createTextNode($posts[$i][$ele->getAttribute("column")]);
					$ele->parentNode->insertBefore($txt, $ele);
				}
			}

			$finder = new DomXPath($doc);
			$nodes = $finder->query("//*[contains(@class, 'column-cat')]");
			// var_dump($nodes);
			if(sizeof($nodes) >= 1) $nodes[0]->setAttribute("class", str_replace("column-categorie", $posts[$i]["categorie"], $nodes[0]->getAttribute("class")));

			$loop = $pok->getElementsByTagName("loop");

			while ($loop->count() >= 1) {
				$loop->item(0)->parentNode->removeChild($loop->item(0));
			}


		}
	}
}

//function qui ajoute du html dans la node
function appendHTML(DOMNode $parent, $source) {
	$tmpDoc = new DOMDocument();
	$html = "<html><body>";
	$html .= $source;
	$html .= "</body></html>";
	$tmpDoc->loadHTML('<?xml encoding="UTF-8">'.$html);

	foreach ($tmpDoc->childNodes as $item)
	if ($item->nodeType == XML_PI_NODE)
		$tmpDoc->removeChild($item);
	$tmpDoc->encoding = 'UTF-8';

	foreach ($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
		$importedNode = $parent->ownerDocument->importNode($node, true);
		$parent->appendChild($importedNode);
	}
}

// function de gestion
function loadTags($ctnt) {
	$dom = new DOMDocument();
	libxml_use_internal_errors(true);
	$dom->loadHTML('<?xml encoding="UTF-8">'.$ctnt);
	libxml_clear_errors();

	// fix UTF-8 problem
	foreach ($dom->childNodes as $item)
	if ($item->nodeType == XML_PI_NODE)
		$dom->removeChild($item);
	$dom->encoding = 'UTF-8';



	$head = $dom->getElementsByTagName("head");
	$t = $dom->createDocumentFragment();
	$p = file_get_contents("../html/includes/head.html");
	$t->appendXML($p);
	$head->item(0)->appendChild($t);

	$test = array();

$list = $dom->getElementsByTagName("tag");

//charge et supprimme les tags
while($lst = $list->item(0)) {

	$tgs = ucfirst($lst->getAttribute("type"));
	array_push($test, $tgs);
	$tg = new $tgs($dom, $lst, false);

	$tg->render();
	// var_dump("--------- 1 ---------");
	// for ($i=0; $i < $list->count(); $i++) {
	// 	var_dump($list->item($i)->getAttribute("type"));
	// }
	// echo (htmlspecialchars($dom->saveHTML()));

	// var_dump($list[0]->parentNode->nodeName);

	$lst->parentNode->removeChild($lst);

	// var_dump("--------- 2 ---------");
	// for ($i=0; $i < $list->count(); $i++) {
	// 	var_dump($list->item($i)->getAttribute("type"));
	// }
	// echo (htmlspecialchars($dom->saveHTML()));

	$list = $dom->getElementsByTagName("tag");
}

	$res = $dom->saveHTML();

	return $res;
}
