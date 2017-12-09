<?php
session_start();
include_once("../db.php");


$_SESSION["ean"] = $_GET["ean"];
$ean = $_SESSION["ean"];
$username = $_SESSION["userid"];
$anzahl = $_GET["anzahl"];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "INSERT INTO cart (ean, anzahl, username) VALUES (:ean, :anzahl, :username)";
$query = $db->prepare($sql);
$query->execute(array('ean'=> $ean, 'anzahl' => $anzahl, "username" => $username));

header("Location: ../../index.php?page=store&action=store");

