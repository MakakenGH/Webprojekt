<?php

include_once "db.php";

$search=$_POST["search"];

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE name=$search";


?>
