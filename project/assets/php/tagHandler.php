<?php
/**
 * <tag type="pokemon" arg="pokemongo"><div class="pokemon-item"></div></tag>
 */

ini_set('display_errors', 'On');

class tag {

	private $DOM;
	private $doc;
	
	public function __construct(DOMDocument $doc, DOMElement $DOMContent) {
		$this->doc = $doc;
		$this->DOM = $DOMContent;
		
	}
	
	public function getDoc() {
		return $this->doc;
	}
	
	public function getDOM() {
		return $this->DOM;
	}

	public function render() {
		return $this->DOM;
	}
}

$post = array(
	'title'=> "test",
	'url'=> "pokemon",
	'content'=> "<p>pouet</p>"
);

$posts = array(
	$post,
	$post,
	$post,
	$post,
);

class bold extends tag {
	public function render() {
		//recuperation de la balise de base (<tag type="bold">pouet</tag>)
		$pok = $this->getDOM();
		//recuperation du document (necessaire a la création de balises
		$doc = $this->getDoc();
		//creation de la balise "div"
		$res = $doc->createElement("div");
		//creation du texte et assignation du texte se trouvant dans la balise de base
		$text = $doc->createTextNode($pok->textContent);
		//on rajoute a notre balise div notre texte
		$res->appendChild($text);
		//on rajoute a la balise div du style pour le mettre en gras
		$res->setAttribute("style", "font-weight: bold");
		//on retourne la div
		return $res;
	}
}

class article extends tag {
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
			$pok->parentNode->appendChild($txt);
		}

		

		return $pok;
	}
}

class loosp extends tag {
	public function render() {
		$el = $this->getDOM();

		$doc = $this->getDoc();

		$limit = (int) $el->getAttribute("limite");

		$parent = $el->parentNode;
		var_dump($limit);
		for ($i=0; $i < $limit; $i++) {
			var_dump($el);
			$parent->appendChild($el);
		}

		return $el;
	}
}

function appendHTML (DOMNode $parent, $source) {
	$tmpDoc = new DOMDocument();
	$tmpDoc->loadHTML ($source);
	foreach ($tmpDoc->getElementsByTagName ('body')->item (0)->childNodes as $node) {
		$importedNode = $parent->ownerDocument->importNode ($node, true);
		$parent->parentNode->replaceChild ($importedNode, $parent);
	}
}

function renameTag( DOMElement $oldTag, $newTagName ) {
	$oldTag = $oldTag->parentNode->appendChild($oldTag);
	$document = $oldTag->ownerDocument;

	$newTag = $document->createElement($newTagName);
	$oldTag->parentNode->replaceChild($newTag, $oldTag);

	foreach ($oldTag->attributes as $attribute) {
		$newTag->setAttribute($attribute->name, $attribute->value);
	}
	foreach (iterator_to_array($oldTag->childNodes) as $child) {
		$newTag->appendChild($oldTag->removeChild($child));
	}
	return $newTag;
}




//testing purpose
$content = file_get_contents("./test.html");

function loadTags($ctnt) {
	$dom = new DOMDocument();
	libxml_use_internal_errors(true);
	$dom->loadHTML($ctnt);
	libxml_clear_errors();
	$list = $dom->getElementsByTagName("tag");
	var_dump($list);
	
	for ($i=0; $i < $list->count(); $i++) {
		$lst = $list->item($i);
		$tgs = $lst->getAttribute("type");
		echo $tgs;
		$tg =  new $tgs($dom, $lst);
		//add to parent the result
		$lst->parentNode->appendChild($tg->render());
	}
	
	
	//remove all tag components
	/*while($list->length >= 1) {
		$list[0]->parentNode->removeChild($list[0]);
	}*/
	$res = $dom->saveHTML();
	echo $res;
}

loadTags($content);
?>