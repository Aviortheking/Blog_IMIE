<?php
/* Fichier qui va gerer la creation de la page et la redirection au cas ou */

ini_set('display_errors', 'On');

// var_dump($_SERVER);

if(endsWith($_GET["page"], ".css")) {
	echo file_get_contents("../css/style.css");
	die;
}


//si on cherche un fichier js
if(endsWith($_GET["page"], ".js")) {
	echo file_get_contents("../js/script.js");
	die;
}

//rajout d'un / a la fin (parceque c'est jolie)
if($_GET["page"] != "" && !endsWith($_GET["page"], "/")) {
	header("Location: /".$_GET["page"]."/");
	die;
}

$_GET['page'] = trim($_GET['page'], '/');
$_GET['page'] = explode('/', $_GET['page'])[0];
if($_GET['page'] == '') {
	$_GET['page'] = 'index';
}

// é

// var_dump($_POST);
// var_dump($_GET);
// die;

include_once "tagHandler.php";
$pokemon = loadTags("../html/".$_GET["page"].".html", false);
// var_dump(mb_detect_encoding($pokemon));

$pokemon = htmlspecialchars_decode($pokemon, ENT_HTML5);
echo $pokemon;
// var_dump(mb_detect_encoding($pokemon));
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

/**
 * classe Pages
 * a constructor to load additionnal pages and initialize the whole class and load the pages
 */

/**
 * Class Pages
 * 
 * attributes
 * pageList : Array
 * 
 * functions
 * 
 * __construct($pages = array())
 * # load the pages list from db and static files (index/search)
 * loadPage($url)
 * # return a class of type Page (see below)
 */

/**
 * class Page
 * contain the Page to load (on init only a light version but when using loadPage the whole page is in the class)
 * here it contains three extended classes (Index/Search/Post where we will add functions to the loadPage)
 */

/**
 * abstract Class Page
 * 
 * attributes
 * id
 * title
 * regex
 * content
 * isLoaded: boolean
 * 
 * functions:
 * __construct(id, title, regex)
 * absract loadPage()
 * 
 */

/**
 * class Post
 * contains a post
 * with basics informations at first and when loadPost is launche the whole class will be usable
 */

/**
 * class Post
 * 
 * attributes
 * id
 * authorName
 * authorLinkedin
 * content
 * isloaded: false
 * 
 * __construct(id);
 * 
 * loadPost()
 * 
 */
