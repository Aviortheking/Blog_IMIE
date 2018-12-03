<?php
/* Fichier qui va gerer la creation de la page et la redirection au cas ou */



$_GET['page'] = trim($_GET['page'], '/');
$_GET['page'] = explode('/', $_GET['page'])[0];
if($_GET['page'] == '') {
	$_GET['page'] = 'index';
}

// var_dump($_POST);
// var_dump($_GET);

include_once "tagHandler.php";
$pokemon = loadTags("../html/".$_GET["page"].".html", false);
$pokemon = mb_convert_encoding($pokemon, "utf-16");
echo $pokemon;
// echo mb_convert_encoding($pokemon, "ascii");
