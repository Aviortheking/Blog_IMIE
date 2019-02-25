<?php

namespace App\DB;

use App\Functions;
use PDO;


class Categorie {

	private $id;

	private $name;

	public function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
	}

	public static function fromArray($array) {
		return new Self($array["id"], $array["name"]);
	}

	/**
	 * Undocumented function
	 *
	 * @param boolean $recent sort by most recent of less recent
	 * @param int $limit
	 *
	 * @return Categorie[]
	 */
	public static function list($recent = true, $limit = 100) {
		$sort = $recent ? "DESC" : "ASC";
		$query = "SELECT * FROM categories ORDER BY " . $sort . " LIMIT " . $limit;

		$pdo = Functions::connect();
		$cats = $pdo->query($query)->fetchAll();

		$res = array();

		foreach ($cats as $cat) {
			$res[] = new Categorie($cat["id"], $cat["name"]);
		}

		return $res;
	}

	public static function get(int $id) {
		return Categorie::fromArray(Functions::connect()->query("SELECT * FROM categories WHERE id=" . $id)->fetch());
	}

	public static function add(Categorie $categorie) {
		$query = "INSERT INTO categories (id, name)
		VALUES (NULL, ':name');";

		$pdo = Functions::connect();
		$prepared = $pdo->prepare($query);
		$prepared->bindParam(":name", $categorie->getName());
		$prepared->execute();
}

	public static function remove(Categorie $categorie) {
		Functions::connect()->prepare("DELETE FROM categories WHERE id=" . $categorie->getName())->execute();

	}

	public static function update(Categorie $categorie) {
		$query = ""
	}


	/**
	 * Get the value of name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}
}
