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
echo "<button type='button' class=\"form-control button_orange\" ><a href='?page=products&editmode=search'><i class='fa fa-wrench'></i>  Bearbeitungsmodus aktivieren</a></button><br>";
echo "</main>";

//Suchergebnisse werden angezeigt
while ($zeile = $query->fetchObject()) {
    echo "<div class='product_backend'>";
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2\" id='store_defined_backend'>";
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "<div class='desc_backend'>";
    echo "<span class='kategorie'>PRODUKTNAME</span><br>";
    echo "<h2><b>$zeile->name</b></h2><br>";
    echo "<span class='kategorie'>BESCHREIBUNG</span><br>";
    echo "<div class='justify'>$zeile->beschreibung</div><br>";
    echo "<span class='kategorie'>BEWERTUNG</span><br>";
    echo "<div>$zeile->rating</div><br>";
    echo "<span class='kategorie'>PREIS</span><br>";
    echo "<div>$zeile->preis €</div><br>";
    echo "<span class='kategorie'>GENRE</span><br>";
    echo "<div>$zeile->genre</div><br>";
    echo "<span class='kategorie'>EAN</span><br>";
    echo "<span>$zeile->ean</span><br>";
    echo "</div>";
    echo "</div>";
    echo "</main>";
}

?>