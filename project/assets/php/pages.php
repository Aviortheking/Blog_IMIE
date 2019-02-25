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

$edit = function() {
	$_POST = array_merge($_POST, $_GET); //debug uniquement
	var_dump($_POST);
	/*
	$_POST should contain
	post :
	id
	title
	content
	category
	author

	UPDATE posts
	SET
	title = title,
	url = strtolower(preg_replace(["/\ /", '/[\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/'], ["_", ""], title));
	content = content,
	short = substr(content, 0, 253) . "...";
	category = categoryId
	author = authorId
	WHERE id = id
	*/

	require_once "functions.php";


	$request = "UPDATE posts SET `title`=:title, `url`=:url, `content`=:content, `short`=:short, `category`=:category, `author`=:author, WHERE `id`=:id";

	$title = $_POST["title"];
	$url = strtolower(preg_replace(["/\ /", '/[\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/'], ["_", ""], $title));
	$content = $_POST["content"];
	$short = substr($content, 0, 253) . "...";
	$category = intval($_POST["category"]);
	$author = intval($_POST["author"]);

	$id = intval($_POST["id"]);


	$pdo = connect();
	$prepared = $pdo->prepare($request);
	$prepared->bindParam(":title", $title);
	$prepared->bindParam(":url", $url);
	$prepared->bindParam(":content", $content);
	$prepared->bindParam(":short", $short);
	$prepared->bindParam(":category", $category, PDO::PARAM_INT);
	$prepared->bindParam(":author", $author, PDO::PARAM_INT);
	$prepared->bindParam(":id", $id, PDO::PARAM_INT);

	$prepared->execute();
};

$router->addRoute("/^\/post\/" . $postCharacters . "+\/edit\/*$/", $edit);
