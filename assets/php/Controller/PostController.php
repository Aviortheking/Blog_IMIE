<?php

namespace App\Controller;

use App\Controller;
use App\DB\Post;
use App\DB\Tag;
use App\Functions;


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

			//move images
			$post = Post::list(true, 1)[0];
			$oldfolder = ROOT."/uploads/posts/new/";
			$files = scandir($oldfolder);
			var_dump($files);
			// die;
			$newfolder = ROOT."/uploads/posts/" . $post->getId() . "/";

			if(!file_exists($newfolder)) {
				mkdir($newfolder, 0700, true);
			}

			foreach($files as $fname) {
				if($fname != '.' && $fname != '..') {
					var_dump($fname);
					rename($oldfolder.$fname, $newfolder.$fname);
				}
			}
			var_dump($newfolder);
			$post->setContent(str_replace("/uploads/posts/new/", "/uploads/posts/" . $post->getId() . "/",$post->getContent()));
			Post::update($post);


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
		Functions::deleteDir(ROOT."/uploads/posts/" . $_GET["post"] . "/");
		header("Location: /");
	}

	/**
	 * @route /^\/post\/([0-9]+\/)*upload\/$/
	 */
	public function upload() {
		if($_GET["post"] && $_FILES["file"]) {

			$post = $_GET['post'];

			if($post == "upload") $post = "new";


			$uploadFolder = DIR."/../uploads/posts/".$post."/";
			var_dump($post);

			if(!file_exists($uploadFolder)) {
				mkdir($uploadFolder, 0700, true);
			}

			if(isset($_FILES["file"]) && !empty($_FILES["file"])) {
				var_dump($_FILES["file"]);
				move_uploaded_file($_FILES["file"]["tmp_name"], $uploadFolder.$_FILES["file"]["name"]);
			}
		}
	}
}
