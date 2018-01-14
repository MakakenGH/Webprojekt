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

    echo "<div>Um diese Funktion nutzen zu können loggen Sie sich bitte ein.<br> <a href='?page=users&action=login'><button class='button_orange'>zum Login</button></a></div>";

}

