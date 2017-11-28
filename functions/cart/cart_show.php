<?php
session_start();

include_once("./functions/db.php");

if (isset($_SESSION['userid'])) {

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM cart";
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<div>";
    echo "<img src='./files/uploads/$zeile->bild'/>&nbsp;";
    echo "<span><b>$zeile->name</b></span>&nbsp;";
    echo "<span>$zeile->beschreibung</span>&nbsp;";
    echo "<span>$zeile->rating</span>&nbsp;";
    echo "<span>$zeile->preis</span>&nbsp;";
    echo "</div><br><br>";}

} else {

    $ean = $_SESSION["cart"];

    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM sortiment WHERE ean=$ean";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<div>";
        echo "<img src='./files/uploads/$zeile->bild'/>&nbsp;";
        echo "<span><b>$zeile->name</b></span>&nbsp;";
        echo "<span>$zeile->beschreibung</span>&nbsp;";
        echo "<span>$zeile->rating</span>&nbsp;";
        echo "<span>$zeile->preis</span>&nbsp;";
        echo "</div><br><br>";}
}