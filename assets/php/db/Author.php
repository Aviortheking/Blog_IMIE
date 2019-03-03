<?php

namespace App\DB;

use App\Functions;

class Author {

	private $id;

	private $username;

	private $password;

	private $job;

	private $role = "ROLE_USER";

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

	public function getRole() {
		return $this->role;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPassword($password) {
		$this->password = password_hash($password, PASSWORD_DEFAULT);
	}

	public function setHashedPassword($password) {
		$this->password = $password;
	}

	public function setJob($job) {
		$this->job = $job;
	}

	public function setRole($role) {
		$this->role = $role;
	}








	public static function fromArray($array) {
		if($array == false) return null;
		$au = new Self();
		$au->setId($array["id"]);
		$au->setUsername($array["username"]);
		$au->setHashedPassword($array["password"]);
		$au->setJob($array["job"]);
		$au->setRole($array["role"]);
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

	public static function getByUsername(String $username) {
		$query = "SELECT * FROM users WHERE username=:username";
		$prepared = Functions::connect()->prepare($query);
		$prepared->bindValue(":username", $username);
		$prepared->execute();
		return Author::fromArray($prepared->fetch());
	}

	public static function add(Author $author) {
		$query = "INSERT INTO users (id, username, password, job, role)
		VALUES (NULL, :username, :password, :job, :role);";

		$username = $author->getUsername();
		$password = $author->getPassword();
		$job = $author->getJob();
		$role = $author->getRole();

		$pdo = Functions::connect();
		$prepared = $pdo->prepare($query);
		$prepared->bindParam(":username", $username);
		$prepared->bindParam(":password", $password);
		$prepared->bindParam(":job", $job);
		$prepared->bindParam(":role", $role);
		$prepared->execute();
		// var_dump($prepared->errorInfo());
		// die;
		return Author::list(true, 1)[0];
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
