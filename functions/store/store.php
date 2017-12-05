<?php
session_start();
include_once("./functions/db.php");

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment ORDER BY rating DESC";
$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";
while ($zeile = $query->fetchObject()) {

    echo "<div class='col-sm-4' id='store_defined'>";
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "<div class='store_text'>";
    echo "<span><b>$zeile->name</b></span><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span><br>";
    echo "<span><a href='?ean=$zeile->ean'>Zur Produktseite</a></span><br>";
    if (isset($_SESSION['userid'])) {
        echo "<span><a class='button_orange' href='./functions/cart/cartupdate_do.php?ean=$zeile->ean'>In den Warenkorb legen</a></span>";}
        else {
        echo "<span><a class='button_orange' href='./functions/cart/cartupdatenologin_do.php?ean=$zeile->ean'>In den Warenenkorb legen</a></span>";
    }
    echo "</div></div><br><br>";}
echo "</div>";
