<?php
session_start();
include_once("../db.php");

if (isset($_SESSION['userid'])) {

    $ean = $_GET["ean"];
    $username = $_SESSION["userid"];
    $anzahl = $_GET["anzahl"];

    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "INSERT INTO cart (ean, anzahl, username) VALUES (:ean, :anzahl, :username)";
    $query = $db->prepare($sql);
    $query->execute(array('ean' => $ean, 'anzahl' => $anzahl, "username" => $username));

    header("Location: ../../index.php?page=store&action=store");

} else {

    $ean = $_GET["ean"];
    $anzahl = $_GET['anzahl'];

    $_SESSION["cart"] = array(array($anzahl, $ean));

    header("Location: ../../index.php?page=store&action=store");
}

