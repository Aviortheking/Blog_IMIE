<?php

namespace App;

use DOMDocument;
use DOMNode;
use PDO;
use App\Router;

/**
 * @author Avior <florian.bouillon@delta-wings.net>
 * @author Clément Fourrier
 */
class Functions {
	public static function endsWith($haystack, $needle) {
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}

	public static function connect() {
		$host = "127.0.0.1";
		$db = "blog";
		$user = "blog";
		$pass = "blog";
		$charset="utf8mb4";

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		try {
			$pdo = new PDO($dsn, $user, $pass, null);
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
		return $pdo;
	}

	/**
	 * Undocumented function
	 *
	 * @param DOMNode $parent
	 * @param [type] $source
	 *
	 * @var DOMNode $node
	 *
	 * @return void
	 */
	public static function appendHTML(DOMNode $parent, $source) {
		$tmpDoc = new DOMDocument("1.0", "UTF-8");
		$html = "<html><body>";
		$html .= $source;
		$html .= "</body></html>";
		$tmpDoc->loadHTML('<?xml encoding="UTF-8">'.$html);

		/** @var DOMNode $item */
		foreach ($tmpDoc->childNodes as $item)
		if ($item->nodeType == XML_PI_NODE)
		$tmpDoc->removeChild($item);
		$tmpDoc->encoding = 'UTF-8';

		/** @var DOMNode $node */
		foreach($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
			$importedNode = $parent->ownerDocument->importNode($node, true);
			$parent->appendChild($importedNode);
		}
	}

	public static function loadRoutes() {
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

			$request = "UPDATE posts SET `title`=:title, `url`=:url, `content`=:content, `short`=:short, `category`=:category, `author`=:author, WHERE `id`=:id";

			$title = $_POST["title"];
			$url = strtolower(preg_replace(["/\ /", '/[\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/'], ["_", ""], $title));
			$content = $_POST["content"];
			$short = substr($content, 0, 253) . "...";
			$category = intval($_POST["category"]);
			$author = intval($_POST["author"]);

			$id = intval($_POST["id"]);


			$pdo = Functions::connect();
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

	}

}
