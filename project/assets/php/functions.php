<?php

//function pour voir la fin d'un texte
function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function connect() {
    $host = "127.0.0.1";
    $db = "blog";
    $user = "username";
    $pass = "motdepasse";
    $charset="utf8mb4";
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}

function getBDD() {

}
