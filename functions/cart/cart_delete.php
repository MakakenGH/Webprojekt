<?php
include_once("../db.php");

$ean = $_POST['ean'];
$anzahl = $_POST['anzahl'];

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "UPDATE cart SET anzahl = anzahl -'".$anzahl."'WHERE ean = '".$ean."'";
$query = $db->prepare($sql);
$query->execute();

$sql2 = "DELETE FROM cart WHERE anzahl <= 0";
$query = $db->prepare($sql2);
$query->execute();

header("Location: ../../index.php?page=warenkorb");