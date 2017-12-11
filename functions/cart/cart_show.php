<?php
session_start();

include_once("../db.php");

if (isset($_SESSION['userid'])) {

    $username = $_SESSION['userid'];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = $db->query("SELECT ean FROM cart WHERE username='" . $username."'");
$results = $sql->fetchAll();

//echo $results[0][0];
var_dump(get_defined_vars());

foreach ($results as $eansingle) {
    $ean = $eansingle["ean"];

    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = $db->query("SELECT * FROM sortiment WHERE ean='" . $ean."'");
    $query = $sql->fetchAll();

    $artikelname = $query['name'];
    echo $artikelname;

   /* echo "<div>";
    echo "<img src='./files/uploads/$query->bild'/>&nbsp;";
    echo "<span><b>$query->name</b></span>&nbsp;";
    echo "<span>$query->beschreibung</span>&nbsp;";
    echo "<span>$query->rating</span>&nbsp;";
    echo "<span>$query->preis</span>&nbsp;";
    echo "</div><br><br>";*/
}


   /* $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM sortiment WHERE ean=$results";
    $query = $db->prepare($sql);
    $query->execute();


    while ($zeile = $query->fetchObject()) {
    echo "<div>";
    echo "<img src='./files/uploads/$zeile->bild'/>&nbsp;";
    echo "<span><b>$zeile->name</b></span>&nbsp;";
    echo "<span>$zeile->beschreibung</span>&nbsp;";
    echo "<span>$zeile->rating</span>&nbsp;";
    echo "<span>$zeile->preis</span>&nbsp;";
    echo "</div><br><br>";}*/

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