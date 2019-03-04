<?php

namespace App\Tags;

use App\Tags\Tag;

/**
 *
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

		$el = $this->getElement();


		if(isset($_SESSION["author"])) {
			if($el->hasAttribute("role") || !$_SESSION["author"]->getRole() == "ROLE_ADMIN") {
				$loggedin = $el->getAttribute("role") == $_SESSION["author"]->getRole();
			} else $loggedin = true;
		} else $loggedin = false;


		//debugging purpose
		// $loggedin = false;
		// var_dump($loggedin);

		foreach ($el->getElementsByTagName("if") as $element) {
			if($element->hasAttribute("true") && $loggedin) {
				$r = $element->childNodes->item(0);
				$el->parentNode->insertBefore($r, $el);
			} elseif ($element->hasAttribute("false") && !isset($_SESSION["author"])) {
				$r = $element->childNodes->item(0);
				$el->parentNode->insertBefore($r, $el);
			}
		}
	}
}
