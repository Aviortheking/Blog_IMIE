<?php

namespace App\DB;

use App\Functions;
use PDO;


class Tag {

	private $id;

	private $name;

	public function __construct() {}

	public static function fromArray($array) {
		$tag = new Tag();
		$tag->setId($array["id"]);
		$tag->setName($array["name"]);
		return $tag;
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
		$query = "SELECT * FROM tag ORDER BY name " . $sort . " LIMIT " . $limit;

		$pdo = Functions::connect();
		$cats = $pdo->query($query)->fetchAll();

		$res = array();

		foreach ($cats as $cat) {
			$res[] = Tag::fromArray($cat);
		}

		return $res;
	}

	public static function get(int $id) {
		return Tag::fromArray(Functions::connect()->query("SELECT * FROM tag WHERE id=" . $id)->fetch());
	}

	/**
	 * Undocumented function
	 *
	 * @param Tag $tag
	 *
	 * @return Tag
	 */
	public static function add(Tag $tag) {
		$query = "INSERT INTO tag (id, name)
		VALUES (NULL, :name);";

		// var_dump($tag);

		$pdo = Functions::connect();
		$prepared = $pdo->prepare($query);
		$prepared->execute(array(":name" => $tag->getName()));

		return Tag::list(true, 1)[0];
}

	public static function remove(Tag $tag) {
		Functions::connect()->prepare("DELETE FROM tag WHERE id=:id")->execute(array(":id" => $tag->getId()));

	}

	public static function update(Tag $tag) {
		Functions::connect()->prepare("UPDATE tag SET name=:name WHERE id=:id")->execute(array(":name" => $tag->getName(), ":id" => $tag->getId()));
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
	public function setId($id) {
		$this->id = $id;
	}
}
