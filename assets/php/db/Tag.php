<?php

namespace App\DB;

use App\Functions;
use PDO;


class Tag {

	private $id;

	private $name;

	public function __construct() {}

	public static function fromArray($array) {
		if($array == false) return false;
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
	 * @return Tag[]
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

	public static function getByName(String $name) {
		$query = "SELECT * FROM tag WHERE name=:name LIMIT 1";
		$prepared = Functions::connect()->prepare($query);
		$prepared->bindValue(":name", $name, PDO::PARAM_STR);
		// $prepared->fetch();
		// $q = Functions::connect()->query("SELECT * FROM tag WHERE name=\"" . $name . "\"");
		// if(!$q) return false;
		$prepared->execute();
		$res = $prepared->fetch(PDO::FETCH_ASSOC);
		// var_dump($res);
		return Tag::fromArray($res);
		// var_dump($name);
		// var_dump($prepared->fetch());
		// var_dump($prepared->errorCode());
		// die;
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

		$name = $tag->getName();

		$pdo = Functions::connect();
		$prepared = $pdo->prepare($query);
		$prepared->execute(array(":name" => $name));
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
		return $this;
	}
}
