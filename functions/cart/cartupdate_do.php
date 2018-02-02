<?php
session_start();
include_once("../db.php");



if (isset($_SESSION['userid'])) {

    $ean = $_GET["ean"];
    $username = $_SESSION["userid"];
    $anzahl = $_GET["anzahl"];

    $db = new PDO($dsn, $dbuser, $dbpass);

    $sql_check = "SELECT * FROM cart WHERE username='".$username."' AND ean='".$ean."'";
    $query = $db->prepare($sql_check);
    $query->execute();

    if ($query->fetchAll()) {
        $sql2 = "UPDATE cart SET anzahl=anzahl+:anzahl WHERE username=:username AND ean=:ean";

    }else {
        $sql2 = "INSERT INTO cart (ean, anzahl, username) VALUES (:ean, :anzahl, :username)";
    }

    $query2 = $db->prepare($sql2);
    $query2->execute(array('ean' => $ean, 'anzahl' => $anzahl, 'username' => $username));


    header("Location: ../../index.php?page=warenkorb");

} else {

    echo "<div>Um diese Funktion nutzen zu können loggen Sie sich bitte ein.<br> <a href='?page=users&action=login'><button class='button_orange'>zum Login</button></a></div>";

}

