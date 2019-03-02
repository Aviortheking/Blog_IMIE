<?php

use App\Router;
use App\Functions;
use App\Tags\Tag;
use App\Controller;
use App\DB\Author;

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require "../../vendor/autoload.php";

$_SESSION["author"] = Author::list(true, 1)[0];

define("DIR", str_replace("/php", "", __DIR__));

//renvoie vers le fichier css si il est demandé
if(Functions::endsWith($_GET["page"], ".css")) {
	echo file_get_contents(DIR . "/css/style.css");
	die;
}

//renvoie vers le fichier js si demandé
if(Functions::endsWith($_GET["page"], ".js")) {
	echo file_get_contents(DIR . "/js/script.js");
	die;
}

// si page non / & finit pas par / at pas de ?
if($_GET["page"] != "" && !Functions::endsWith($_GET["page"], "/") && count($_GET) <= 2) {
	header("Location: /".$_GET["page"]."/");
	die;
}

/**
 *  ex: /post/test/ => post/test
 * utilité ? pouet simplefier la séparation pour les lignes d'après
 */
$_GET['page'] = trim($_GET['page'], '/');

/**
 * ex: $_GET['page'] = post/test => $_GET['page'] = post/test & $_GET['post'] = test
 */
if(count(explode("/", $_GET["page"])) > 1) {
	$_GET["post"] = explode("/", $_GET["page"])[1];
}

/**
 * changer le $_GET["page"] pour rajouter le slash avant
 * ex : post/test => /post/test
 */
$_GET['page'] = "/" . $_GET['page'];

/**
 * si page ne finit pas par / rajouter un /
 * ex : /post/test => /post/test/
 * utilité ? afin de faire la recherche des controllers
 */
if(strlen($_GET['page']) > 1) {
	$_GET['page'] = $_GET["page"] . "/";
}

//debug
if($_GET["page"] == "/test/") {
	require "test.php";
	die;
}

/**
 * Démarrage du routage du contenu
 */
$controller = new Controller();
echo Tag::loadTags($controller->getContent($_GET["page"], $loader));
