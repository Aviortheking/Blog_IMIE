<?php
require_once "functions.php";

error_reporting(E_ALL);
ini_set('display_errors', 'On');

//renvoie vers le fichier css si il est demandé
if(endsWith($_GET["page"], ".css")) {
	echo file_get_contents("../css/style.css");
	die;
}

//renvoie vers le fichier js si demandé
if(endsWith($_GET["page"], ".js")) {
	echo file_get_contents("../js/script.js");
	die;
}

// var_dump(sizeof($_GET));

// si page non / & finit pas par / at pas de ?
if($_GET["page"] != "" && !endsWith($_GET["page"], "/") && sizeof($_GET) <= 1) {
	header("Location: /".$_GET["page"]."/");
	die;
}

//enleve les / du début & fin
$_GET['page'] = trim($_GET['page'], '/');

// si taille supérieur à 1 $_getpost = element
if(sizeof(explode("/", $_GET["page"])) > 1) {
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
	include_once "test.php";
	die;
}

/**
 * Démarrage du routage du contenu
 */

include_once "router.php";
$router = new Router();
include_once "pages.php";


//chargement des tags contenu sur la page
include_once "tagHandler.php";
$pokemon = loadTags($router->search($_GET["page"])(), false);

echo $pokemon;
