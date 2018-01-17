<?php
session_start();
include_once "./functions/db.php";
$search2 = $_SESSION["search_save"];

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search2."%' OR name LIKE '%".$search2."%'";


$query = $db->prepare($sql);
$query->execute();
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";

echo "<span><a href='?page=products&editmode=search'>Bearbeitungsmodus aktivieren</a></span><br>";
echo "</main>";
while ($zeile = $query->fetchObject()) {
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
    echo "<img src='./files/uploads/$zeile->bild'/><br>";
    echo "<span><b>$zeile->name</b></span><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span> €<br>";
	echo "<span>$zeile->genre</span><br>";
	echo "<span>$zeile->ean</span><br>";
    echo "</div></div><br><br>";
    echo "<main>";
}

?>