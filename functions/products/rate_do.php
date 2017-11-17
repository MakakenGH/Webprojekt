<?php
$rating = $_POST["rate"];
$ean=$_POST["ean"];

include_once ("../db.php");

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT rating FROM sortiment WHERE ean=$rating";
$query = $db->prepare($sql);
$query->execute();
