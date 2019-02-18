<?php
include_once "router.php";

//recupération du router
$router = Router::getRouter();

$postCharacters = "[a-z0-9-]";

//page d'accueil
$home = function () {
	return file_get_contents("../html/index.html");
};

$router->addRoute("/^\/$/", $home); // route : "/"

//page de post
$post = function () {
	return file_get_contents("../html/post.html");
};

$router->addRoute("/^\/post\/" . $postCharacters . "+\/*$/", $post); // route "/post/*"

//page de recherche
$search = function () {
	return file_get_contents("../html/search.html");
};

$router->addRoute("/^\/search\/$/", $search); // route "/search/*"

$post = function() {
	var_dump("tst");
};

$router->addRoute("/^\/post\/" . $postCharacters . "+\/edit\/*$/", $post);
