<?php

namespace App\Controller;
use App\Controller;
use App\DB\Author;

class UserController extends Controller {


	/**
	 * @route /^\/users\/new\/$/
	 * @admin
	 * @title Ajouter un utilisateur
	 */
	public function addUser() {

		if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["role"])) {
			$user = new Author();
			$user->setUsername($_POST["username"]);
			$user->setPassword($_POST["password"]);
			$user->setRole($_POST["role"]);
			Author::add($user);
			header("Location: /users/");
		}

		return \file_get_contents(DIR . "/html/user_add.html");
	}

	/**
	 * @route /^\/users\/$/
	 * @admin
	 * @title liste des utilisateurs
	 */
	public function listUser() {
		return \file_get_contents(DIR."/html/user_list.html");
	}

	/**
	 * @route /\/users\/[0-9]+\/edit\/$/
	 * @admin
	 * @title Modifier un utilisateur
	 */
	public function editUser() {
		var_dump($_POST);
		$_GET['edit_user'] = explode("/", $_GET["page"])[2];

		if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["job"]) && isset($_POST["role"])) {
			$user = Author::get($_GET["edit_user"]);
			$user->setUsername($_POST["username"]);
			if($_POST["password"] != '') $user->setPassword($_POST["password"]);
			$user->setRole($_POST["role"]);
			var_dump($user);
			Author::update($user);
			// header("Location: /users/");
		}
		return file_get_contents(DIR."/html/user_edit.html");
	}

	/**
	 * @route /\/users\/[0-9]+\/delete\/$/
	 * @admin
	 * @title Modifier un utilisateur
	 */
	public function deleteUser() {
		$_GET['edit_user'] = explode("/", $_GET["page"])[2];
		Author::remove(Author::get($_GET["edit_user"]));
		header("Location: /users/");
	}



}
