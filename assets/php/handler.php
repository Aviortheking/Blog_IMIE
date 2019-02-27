<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "../../vendor/autoload.php";

use App\Router;
use App\Functions;
use App\Tags\Tag;

//renvoie vers le fichier css si il est demand�
if(Functions::endsWith($_GET["page"], ".css")) {
	echo file_get_contents("../css/style.css");
	die;
}

//renvoie vers le fichier js si demand�
if(Functions::endsWith($_GET["page"], ".js")) {
	echo file_get_contents("../js/script.js");
	die;
}

// var_dump(sizeof($_GET));

// si page non / & finit pas par / at pas de ?
if($_GET["page"] != "" && !Functions::endsWith($_GET["page"], "/") && count($_GET) <= 1) {
	header("Location: /".$_GET["page"]."/");
	die;
}

//enleve les / du d�but & fin
$_GET['page'] = trim($_GET['page'], '/');

// si taille sup�rieur � 1 $_getpost = element
if(count(explode("/", $_GET["page"])) > 1) {
	$_GET["post"] = explode("/", $_GET["page"])[1];
}

// $_get[page] = $_get[page][0]
$_GET['page'] = "/" . $_GET['page'];

// si len $_get[page] > 1 (mot ou autre) on rajoute le slash de fin
if(strlen($_GET['page']) > 1) {
	$_GET['page'] = $_GET["page"] . "/";
}

// var_dump($_GET["page"]);

//page de test pour des functions
// A ENLEVER LORS DES COMMITS DE FIN
// var_dump($_GET);
if($_GET["page"] == "/test/") {
	require_once "test.php";
	die;
}

/**
 * D�marrage du routage du contenu
 */

$router = new Router();

Functions::loadRoutes();



//chargement des tags contenu sur la page

$pokemon = Tag::loadTags($router->search($_GET["page"])(), false);

echo $pokemon;
