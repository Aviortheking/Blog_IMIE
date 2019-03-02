<?php

namespace App\DB;

use App\Functions;

class Author {

	private $id;

	private $username;

	private $password;

	private $job;

	public function __construct(){}

	public function getId() {
		return $this->id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function checkPassword($password) {
		return password_verify($password, $this->password);
	}

	public function getPassword() {
		return $this->password;
	}

	public function getJob() {
		return $this->job;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPassword($password) {
		$this->password = \password_hash($password, PASSWORD_DEFAULT);
	}

	public function setJob($job) {
		$this->job = $job;
	}








	public static function fromArray($array) {
		$au = new Self();
		$au->setId($array["id"]);
		$au->setUsername($array["username"]);
		$au->setPassword($array["password"]);
		$au->setJob($array["job"]);
		return $au;
	}

	public static function list($recent = true, $limit = 100) {
		$sort = $recent ? "DESC" : "ASC";
		$query = "SELECT * FROM users ORDER BY id " . $sort . " LIMIT " . $limit;

		$pdo = Functions::connect();
		$cats = $pdo->query($query)->fetchAll();

		$res = array();

		foreach ($cats as $cat) {
			$res[] = Author::fromArray($cat);
		}

		return $res;
	}

	public static function get(int $id) {
		return Author::fromArray(Functions::connect()->query("SELECT * FROM users WHERE id=" . $id)->fetch());
	}

	public static function add(Author $author) {
		$query = "INSERT INTO author (id, username, password, job)
		VALUES (NULL, ':username', ':password', ':job');";

		$pdo = Functions::connect();
		$prepared = $pdo->prepare($query);
		$prepared->bindParam(":username", $author->getUsername());
		$prepared->bindParam(":password", $author->getPassword());
		$prepared->bindParam(":job", $author->getjob());
		$prepared->execute();
}

	public static function remove(Author $author) {
		Functions::connect()->prepare("DELETE FROM author WHERE id=:id")->execute(array(":id" => $author->getId()));

	}

	public static function update(Author $author) {
		Functions::connect()->prepare("UPDATE author SET name=':name', password=':password', job=':job' WHERE id=:id")->execute(array(
			":username" => $author->getUsername(),
			":password" => $author->getPassword(),
			":job" => $author->getJob(),
			":id" => $author->getId()
		));
	}



}
