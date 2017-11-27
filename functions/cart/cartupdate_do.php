<?php
include_once("../db.php");

$ean= (int)$_GET["ean"];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "INSERT INTO cart (ean, name, beschreibung, genre, preis, rating, bild) SELECT ean, name, beschreibung, genre, preis, rating, bild  
FROM sortiment  WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();

header("Location: ../../index.php");

