<?php

namespace App\Controller;

use App\Controller;
use App\DB\Post;
use App\DB\Tag;

class HomeController extends Controller {


	/**
	 * @route /^\/$/
	 * @title Accueil
	 */
	public function home() {
		return file_get_contents(DIR."/html/index.html");
	}


	/**
	 * @route /^\/search\//
	 * @title Rechercher
	 */
	public function search() {
		return file_get_contents(DIR."/html/search.html");
	}
}
