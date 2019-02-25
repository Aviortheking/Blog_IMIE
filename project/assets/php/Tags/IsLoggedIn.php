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
