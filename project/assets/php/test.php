<?php
include_once "functions.php";
$pdo = connect();
$query = $pdo->query("SELECT title, categorie, dt as date, short as content
FROM posts
ORDER BY date DESC
LIMIT 6");
while($row = $query->fetch()) {
    echo $row["title"];
}
// var_dump(connect());