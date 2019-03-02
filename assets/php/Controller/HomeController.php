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
	 * @route /^\/post\/new\/*$/
	 */
	public function postAdd() {

		// var_dump($_SESSION["author"]);
		// die;

		if(isset($_GET["title"]) && isset($_GET["category"]) && isset($_GET["content"]) && isset($_GET["tags"])) {
			$post = new Post();

			$post->setTitle($_GET["title"]);
			$post->setContent($_GET["content"]);
			$post->setCategory($_GET["category"]);
			// $post->setAuthor();
			$tags = explode(",", $_GET["tags"]);
			$tgs = array();
			foreach ($tags as $tag) {
				$new_tag = explode(":", $tag);
				if(count($new_tag) > 1) {
					$t = new Tag();
					$t->setName($new_tag[1]);
					$tgs[] = Tag::add($t)->getId();
				} else {
					$tgs[] = $tag;
				}
			}
			$post->setTags($tgs);
			$post->setAuthor($_SESSION["author"]->getId());
			Post::add($post);
		}

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
