<?php

$ean = $_POST["ean"];
$oldbild = $_POST["oldbild"]; //Zu löschendes Bild wird in einer Variable gespeichert

try {
    include_once("../../db.php");
    //Produkt wird aus der DB gelöscht
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "DELETE FROM sortiment WHERE ean='".$ean."'";
    $db->prepare($sql)->execute();
    $db = null;
    //Bild wird vom Server gelöscht
    unlink ('../../../files/uploads/'.$oldbild);
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

header('Location: ../../../admin.php');