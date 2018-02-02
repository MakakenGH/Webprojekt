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

//Suchergebnisse werden ausgegeben
if($query->fetchObject()) {
    //Bearbeitungsmodus aktivieren Button
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
    echo "<a style='text-decoration: none' href='?page=products&editmode=search'><button type='button' class=\"form-control button_orange\" ><i class='fa fa-wrench'></i>  Bearbeitungsmodus aktivieren</button></a><br>";
    echo "</main>";

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
}
else {
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 text-center\" style='color: #333;'>";
    echo "Suche lieferte keine Ergebnisse";
    echo "</main>";
}
?>