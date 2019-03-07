<?php

namespace App;

use DOMDocument;
use DOMNode;
use PDO;
use PDOException;

class Functions {

	/**
	 * check the end of $needl
	 *
	 * @param String $haystack
	 * @param String $needle
	 *
	 * @return bool
	 */
	public static function endsWith(String $haystack, String $needle): bool {
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}

		return (substr($haystack, -$length) === $needle);
	}

	/**
	 * Connect to Database
	 *
	 * @return PDO
	 */
	public static function connect(): PDO {

		$host = "127.0.0.1";
		$db = "blog";
		$user = "blog";
		$pass = "blog";
		$charset="utf8mb4";

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		try {
			$pdo = new PDO($dsn, $user, $pass, null);
		} catch (PDOException $e) {
			throw new PDOException($e->getMessage(), (int)$e->getCode());
		}
		return $pdo;
	}

	/**
	 * Append HTML to DOMDocument
	 *
	 * @param DOMNode $parent
	 * @param String $source
	 */
	public static function appendHTML(DOMNode $parent, String $source) {
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

	public static function deleteDir($dirPath) {
		if (is_dir($dirPath)) {
			if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
				$dirPath .= '/';
			}
			$files = glob($dirPath . '*', GLOB_MARK);
			foreach ($files as $file) {
				if (is_dir($file)) {
					self::deleteDir($file);
				} else {
					unlink($file);
				}
			}
			rmdir($dirPath);
		}
	}
}
