<?php

namespace App\Controller;

use App\Controller;
use App\DB\Post;
use App\DB\Tag;


class PostController extends Controller {

	/**
	 * @route /^\/post\/$/
	 * @title Modification d'article
	 */
	public function blog() {
		header("Location: /post/".Post::list(true, 1)[0]->getId() . "/");
	}


	/**
	 * @route /^\/post\/[0-9]+\/edit\/$/
	 * @editor
	 * @title Modification d'article
	 */
	public function postEdit() {
		if(isset($_GET["post"]) && isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["content"]) && isset($_POST["tags"])) {
			var_dump($_POST["content"]);
			$post = Post::get($_GET["post"]);

			$post->setTitle($_POST["title"]);
			$post->setContent($_POST["content"]);
			$post->setCategory($_POST["category"]);

			$tags = explode(",", $_POST["tags"]);
			$tgs = array();
			foreach ($tags as $tag) {
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
	 * @title Ajout d'Article
	 */
	public function postAdd() {
		var_dump($_POST);
		if(isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["content"]) && isset($_POST["tags"])) {
			$post = new Post();

			$post->setTitle($_POST["title"]);
			$post->setContent($_POST["content"]);
			$post->setCategory($_POST["category"]);
			// $post->setAuthor();
			$tags = explode(",", $_POST["tags"]);
			$tgs = array();
			foreach ($tags as $tag) {
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


	/**
	 * @route /^\/post\/[0-9]+\/$/
	 * @title Article
	 */
	public function post() {
		return file_get_contents(DIR."/html/post.html");
	}

	/**
	 * @route /^\/post\/[0-9]+\/delete\/$/
	 * @title Article
	 */
	public function delete() {
		Post::remove(Post::get($_GET["post"]));
		header("Location: /");
	}

	/**
	 * @route /^\/post\/[0-9]+\/upload\/$/
	 */
	public function upload() {
		if($_GET["post"] && $_FILES["file"]) {

			$post = $_GET['post'];

			if($post == "new") $post = "temp";


			$uploadFolder = DIR."/../uploads/posts/".$_GET["post"]."/";

			if(!file_exists($uploadFolder)) {
				mkdir($uploadFolder, 0660, true);
			}

			if(isset($_FILES["file"]) && !empty($_FILES["file"])) {
				var_dump($_FILES["file"]);
				move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFolder.$_FILES["file"]["name"]);
				// require_once "functions.php";
				// file_put_contents($uploadFolder."/pouet.jpg", base64_decode($_POST["image"]));
				// base64_to_jpeg($_POST["image"], $uploadFolder."/pouet.jpg");
				// file_put_content($uploadFolder."/pouet.jpg", base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST["image"])));
			}
		}
	}
}
