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
	 * @route /\/users\/edit\/[0-9]+\/$/
	 * @admin
	 * @title Modifier un utilisateur
	 */
	public function editUser() {
		$_GET['edit_user'] = explode("/", $_GET["page"])[3];
		return \file_get_contents(DIR."/html/user_edit.html");
	}



}
