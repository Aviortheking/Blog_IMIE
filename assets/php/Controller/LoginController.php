<?php

namespace App\Controller;

use App\Controller;
use App\DB\Author;


class LoginController extends Controller {


	/**
	 * @route /^\/login\/$/
	 * @title Login
	 */
	public function login() {

		if(isset($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"]) && !empty($_POST["username"])) {
			$user = Author::getByUsername($_POST["username"]);
			if($user->checkPassword($_POST["password"])) {
				$_SESSION["author"] = $user;
				header("Location: /");
			}
			else var_dump("login incorreect");
		}

		return file_get_contents(DIR."/html/login.html");
	}

	/**
	 * @route /^\/logout\/$/
	 */
	public function logout() {
		session_destroy();
		header("Location: /");
	}

	/**
	 * @route /^\/register\/$/
	 * @title Register
	 */
	public function register() {
		if(isset($_POST["password"]) && isset($_POST["username"]) && Author::getByUsername($_POST["username"]) === null && !empty($_POST["password"]) && !empty($_POST["username"])) {
			$user = new Author();
			$user->setUsername($_POST["username"]);
			$user->setPassword($_POST["password"]);
			$user = Author::add($user);
			$_SESSION["author"] = $user;
			header("Location: /");
		}
		return file_get_contents(DIR."/html/register.html");
	}

}
