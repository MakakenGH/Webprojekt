<?php
session_start();
include_once("./functions/db.php");
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";

echo "<span><a href='?page=products&editmode=overview'>Bearbeitungsmodus aktivieren</a></span><br>";
echo "</main>";
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment ORDER BY ean ASC";
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
    echo "<img src='./files/uploads/$zeile->bild'/><br>";
    echo "<span><b>$zeile->name</b></span><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span> €<br>";
    echo "<span>$zeile->genre</span><br>";
    echo "<span>$zeile->ean</span><br>";
    echo "</main>";
}
