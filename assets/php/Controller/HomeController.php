<?php

namespace App\Controller;

class HomeController extends \App\Controller {


	/**
	 * @route /^\/$/
	 */
	public function home() {
		return file_get_contents(DIR."/html/index.html");
	}

	/**
	 * @route /^\/post\/[a-z0-9]+\/*$/
	 */
	public function post() {
		return file_get_contents(DIR."/html/post.html");
	}

	/**
	 * @route /^\/search\//
	 */
	public function search() {
		return file_get_contents(DIR."/html/search.html");
	}
}
