<?php

namespace App\Tags;

use DOMDocument;
use DOMElement;
use DOMNode;

class Tag {

	/** @var DOMDocument */
	private $document;

	/** @var DOMElement */
	private $element;

	/** @var boolean */
	private $debug;

	/**
	 * Tag Constructor (will receive variables used in the tags)
	 *
	 * @param DOMDocument $doc the document
	 * @param DOMElement $DOMContent the element
	 * @param boolean $debug is debug enable or not ?
	 */
	public function __construct(DOMDocument $document, DOMElement $element, bool $debug) {
		$this->document = $document;
		$this->element = $element;
		$this->debug = $debug;
	}

	/** @return DOMDocument return the document */
	public function getDoc(): DOMDocument {
		return $this->document;
	}

	/**
	 * get the element
	 *
	 * @return DOMElement the element
	 */
	public function getElement(): DOMElement {
		return $this->element;
	}

	/** @return boolean */
	public function isDebugging(): bool {
		return $this->debug;
	}

	public function render() {}

	/**
	 * Load tags from html $content and return the resulting String
	 *
	 * @param String $content base html file containing <tag />
	 *
	 * @return String the result html
	 */
	public static function loadTags(String $content): String {
		$dom = new DOMDocument('1.0', 'UTF-8');
		libxml_use_internal_errors(true);
		$dom->loadHTML('<?xml encoding="UTF-8">'.$content);
		libxml_clear_errors();

		// fix UTF-8 problem
		/** @var DOMNode $item */
		foreach ($dom->childNodes as $item)
		if ($item->nodeType == XML_PI_NODE)
			$dom->removeChild($item);
		$dom->encoding = 'UTF-8';



		$head = $dom->getElementsByTagName("head");
		if($head->count() >= 1) {
			$t = $dom->createDocumentFragment();
			$p = file_get_contents("../html/includes/head.html");
			$t->appendXML($p);
			$head->item(0)->appendChild($t);
		}


		$list = $dom->getElementsByTagName("tag");

		//charge et supprimme les tags
		while($lst = $list->item(0)) {

			$tgs = "\\App\\Tags\\" . ucfirst($lst->getAttribute("type"));
			$tg = new $tgs($dom, $lst, false);

			$tg->render();

			$lst->parentNode->removeChild($lst);

			$list = $dom->getElementsByTagName("tag");
		}

		$res = $dom->saveHTML();

		return $res;
	}

}
