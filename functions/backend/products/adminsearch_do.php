<?php
session_start();
include_once "./functions/db.php";


$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";
$_SESSION["search_save"] = $search;

$query = $db->prepare($sql);
$query->execute();

echo "<span><a href='?page=products&editmode=search'>Bearbeitungsmodus aktivieren</a></span><br>";

while ($zeile = $query->fetchObject()) {
    echo "<img src='./files/uploads/$zeile->bild'/><br>";
    echo "<span><b>$zeile->name</b></span><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span> €<br>";
	echo "<span>$zeile->genre</span><br>";
	echo "<span>$zeile->ean</span><br>";
    echo "</div></div><br><br>";
}

?>