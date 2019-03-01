<?php

namespace App\DB;

use App\Functions;
use PDO;


class Category {

	private $id;

	private $name;



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

	public function __construct() {}

		public static function fromArray($array) {
			$cat = new Category();
			$cat->setId($array["id"]);
			$cat->setName($array["name"]);
			return $cat;
		}

		/**
		 * Undocumented function
		 *
		 * @param boolean $recent sort by most recent of less recent
		 * @param int $limit
		 *
		 * @return Category[]
		 */
		public static function list($recent = true, $limit = 100) {
			$sort = $recent ? "DESC" : "ASC";
			$query = "SELECT * FROM categories ORDER BY " . $sort . " LIMIT " . $limit;

			$pdo = Functions::connect();
			$cats = $pdo->query($query)->fetchAll();

			$res = array();

			foreach ($cats as $cat) {
				$res[] = Category::fromArray($cat);
			}

			return $res;
		}

		public static function get(int $id) {
			return Category::fromArray(Functions::connect()->query("SELECT * FROM categories WHERE id=" . $id)->fetch());
		}

		public static function add(Category $categorie) {
			$query = "INSERT INTO categories (id, name)
			VALUES (NULL, ':name');";

			$pdo = Functions::connect();
			$prepared = $pdo->prepare($query);
			$prepared->bindParam(":name", $categorie->getName());
			$prepared->execute();
	}

		public static function remove(Category $categorie) {
			Functions::connect()->prepare("DELETE FROM categories WHERE id=:id")->execute(array(":id" => $categorie->getId()));

		}

		public static function update(Category $categorie) {
			Functions::connect()->prepare("UPDATE categorie SET name=:name WHERE id=:id")->execute(array(":name" => $categorie->getName(), ":id" => $categorie->getId()));
		}

}
