<?php

// abstract class Page {
// 	private $id;
// 	private $title;
// 	private $regex;
// 	private $content;
// 	private $isLoaded = false;

// 	abstract function loadPage();
// }

// interface Page {
// 	public function __construct();
// 	public function loadPage();
// 	public function getId();
// 	public function getTitle();
// 	public function getRegex();
// }



// class Post {
// 	private $id;
// 	private $authorName;
// 	private $authorLinkedin;
// 	private $content;
// 	private $isLoaded = false;

// 	public function __construct($id) {
// 		$this->id = $id;
// 	}

// 	public function loadPost() {

// 	}

// }


// class Posts implements Page {
// 	public function __construct() {}
	
// }

include_once "router.php";

$router = Router::getRouter();

$home = function() {
	return file_get_contents("../html/index.html");
};

$router->addRoute("/^\/$/", $home);

$post = function() {
	return file_get_contents("../html/post.html");
};

$router->addRoute("/^\/post\/$/", $post);

$search = function() {
	return file_get_contents("../html/search.html");
};

$router->addRoute("/^\/search\/$/", $search);
