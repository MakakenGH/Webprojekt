<?php

$ean = $_POST["ean"];
$oldbild = $_POST["oldbild"];

try {
    include_once("../../db.php");
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "DELETE FROM sortiment WHERE ean='".$ean."'";
    $db->prepare($sql)->execute();
    $db = null;
    unlink ('../../../files/uploads/'.$oldbild);
} catch (PDOException $e) {
    echo "Error!: Bitten wenden Sie sich an den Administrator...";
    die();
}

header('Location: ../../../admin.php');