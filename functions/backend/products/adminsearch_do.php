<?php
session_start();
include_once "./functions/db.php";

//Sucheingabe wird in einer Session gespeichert um sie zu speichern
$_SESSION["search_save"] = $search;

//DB Verbindung
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";
$query = $db->prepare($sql);
$query->execute();

//Bearbeitungsmodus aktivieren Button
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
echo "<button type='button' class=\"form-control button_orange\" ><a href='?page=products&editmode=search'><i class='fa fa-wrench'></i>  Bearbeitungsmodus aktivieren</a></button><br>";
echo "</main>";

//Suchergebnisse werden ausgegeben
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
    echo "</main>";
}
?>