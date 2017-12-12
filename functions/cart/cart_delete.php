<?php
include_once("../db.php");

$ean = $_POST['ean'];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "DELETE FROM cart WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();

header("Location: ../../index.php?page=warenkorb");