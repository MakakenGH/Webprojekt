<?php
session_start();
include_once("./functions/db.php");
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
echo "<button type='button' class='form-control button_orange'><a style='color:white;' href='?page=products&editmode=overview'><i class='fa fa-wrench'></i>  Bearbeitungsmodus aktivieren</a></button><br>";
echo "</main>";
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment ORDER BY ean ASC";
$query = $db->prepare($sql);
$query->execute();
while ($zeile = $query->fetchObject()) {
    echo "<div class='product_backend'>";
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2\" id='store_defined_backend'>";
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "<div class='desc_backend'>";
    echo "<h2><b>$zeile->name</b></h2><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span> €<br>";
    echo "<span>$zeile->genre</span><br>";
    echo "<span>$zeile->ean</span><br>";
    echo "</div>";
    echo "</div>";
    echo "</main>";
}

