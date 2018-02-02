<?php
session_start();
include_once("../db.php");

if (isset($_SESSION['userid'])) {

    $ean = $_GET["ean"];
    $username = $_SESSION["userid"];
    $anzahl = $_GET["anzahl"];

    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "INSERT INTO cart (ean, anzahl, username) VALUES (:ean, :anzahl, :username) ON DUPLICATE KEY UPDATE anzahl = anzahl + :anzahl";
    //Falls das schreiben in die DB einen doppelten wert für ein UNIQUE oder PRiMARY KEY wert verursachen würde,
    // wird anstelle von INSERT der UPDATE befehl ausgeführt
    $query = $db->prepare($sql);
    $query->execute(array('ean' => $ean, 'anzahl' => $anzahl, "username" => $username));

    header("Location: ../../index.php?page=store&action=store");
}


