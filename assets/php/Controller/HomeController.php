<?php

namespace App\Controller;

use App\Controller;

class HomeController extends Controller {


	/**
	 * @route /^\/$/
	 */
	public function home() {
		return file_get_contents(DIR."/html/index.html");
	}

	/**
	 * @route /^\/post\/new\/*$/
	 */
	public function postAdd() {
		return file_get_contents(DIR."/html/post_new.html");
	}

	/**
	 * @route /^\/post\/[a-z0-9]+\/$/
	 */
	public function post() {
		return file_get_contents(DIR."/html/post.html");
	}

	/**
	 * @route /^\/post\/[a-z0-9]+\/edit\/$/
	 */
	public function postEdit() {
		return file_get_contents(DIR."/html/post_edit.html");
	}





	/**
	 * @route /^\/search\//
	 */
	public function search() {
		return file_get_contents(DIR."/html/search.html");
	}
}
