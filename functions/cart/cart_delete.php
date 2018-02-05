<?php
session_start();

include_once("../db.php");

$ean = $_POST['ean'];
$anzahl = $_POST['anzahl'];
$username = $_SESSION['userid'];
//Datenbankabfrage
$db = new PDO($dsn, $dbuser, $dbpass);
//Zuvorgewählte Anzahl an Produkten werden aus Datenbank bei jeweiligem User gelöscht.
$sql = "UPDATE cart SET anzahl = anzahl -'".$anzahl."'WHERE ean = '".$ean."' AND username = '".$username."'";
$query = $db->prepare($sql);
$query->execute();
//Wenn die Anzahl kleiner als 0, wird gesamter DB-Eintrag gelöscht.
$sql2 = "DELETE FROM cart WHERE anzahl <= 0";
$query = $db->prepare($sql2);
$query->execute();

header("Location: ../../index.php?page=warenkorb");