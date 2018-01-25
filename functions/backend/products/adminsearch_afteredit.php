<!-- Dokument ist dazu da dass nach dem Bearbeitungsmodus wieder die zuvor gesuchten Produkte angezeigt werden-->
<?php
session_start();
include_once "./functions/db.php";

//Sucheingabe wird aus der Session geladen
$search2 = $_SESSION["search_save"];

//DB Verbindung
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search2."%' OR name LIKE '%".$search2."%'";
$query = $db->prepare($sql);
$query->execute();

//Bearbeitungsmodus aktivieren Button
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
echo "<span><a href='?page=products&editmode=search'>Bearbeitungsmodus aktivieren</a></span><br>";
echo "</main>";

//Suchergebnisse werden angezeigt
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
    echo "</div></div>";
    echo "<main>";
}

?>