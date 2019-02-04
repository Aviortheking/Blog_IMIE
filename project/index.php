<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "assets/php/functions.php";

$host = "127.0.0.1";
$db = "blog";
$user = "root";
$pass = "root";
$charset="utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
echo "pokemon";
?>