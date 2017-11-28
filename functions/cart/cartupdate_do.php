<?php
session_start();
include_once("../db.php");


$_SESSION["ean"] = $_GET["ean"];
$ean = $_SESSION["ean"];
$username = $_SESSION["userid"];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "INSERT INTO cart (ean, username) VALUES (:ean, :username)";
$query = $db->prepare($sql);
$query->execute(array('ean'=> $ean, "username" => $username));

header("Location: ../../index.php?page=store&action=store");

