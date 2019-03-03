<?php

namespace App\Controller;

use App\Controller;
use App\DB\Post;
use App\DB\Tag;


class AddEditController extends Controller {
	/**
	 * @route /^\/post\/[0-9]+\/edit\/$/
	 * @editor
	 */
	public function postEdit() {
		if(isset($_GET["post"]) && isset($_GET["title"]) && isset($_GET["category"]) && isset($_GET["content"]) && isset($_GET["tags"])) {
			$post = Post::get($_GET["post"]);

			$post->setTitle($_GET["title"]);
			$post->setContent($_GET["content"]);
			$post->setCategory($_GET["category"]);

			$tags = explode(",", $_GET["tags"]);
			$tgs = array();
			foreach ($tags as $tag) {
				var_dump($tag);
				var_dump(Tag::getByName($tag));
				if(!(Tag::getByName($tag))) {
					$tgs[] = Tag::add((new Tag())->setName($tag))->getId();
				} else {
					$tgs[] = Tag::getByName($tag)->getId();
				}
			}

			$post->setTags($tgs);
			$post->setAuthor($_SESSION["author"]->getId());
			Post::update($post);
		}
		return file_get_contents(DIR."/html/post_edit.html");
	}

	/**
	 * @route /^\/post\/new\/*$/
	 * @editor
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
				var_dump($tag);
				var_dump(Tag::getByName($tag));
				if(!(Tag::getByName($tag))) {
					$tgs[] = Tag::add((new Tag())->setName($tag))->getId();
				} else {
					$tgs[] = Tag::getByName($tag)->getId();
				}
			}
			// var_dump($tgs);
			// die;
			$post->setTags($tgs);
			$post->setAuthor($_SESSION["author"]->getId());
			Post::add($post);
		}

		return file_get_contents(DIR."/html/post_new.html");
	}
}
