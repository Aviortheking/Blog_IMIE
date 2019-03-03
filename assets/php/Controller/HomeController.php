<?php

namespace App\Controller;

use App\Controller;
use App\DB\Post;
use App\DB\Tag;

class HomeController extends Controller {


	/**
	 * @route /^\/$/
	 */
	public function home() {
		return file_get_contents(DIR."/html/index.html");
	}

	/**
	 * @route /^\/post\/[0-9]+\/$/
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
