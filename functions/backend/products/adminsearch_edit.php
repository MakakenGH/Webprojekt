<?php
session_start();
include_once("./functions/db.php");

//Bearbeitungsmodus deaktivieren Button
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";
echo "<a style='text-decoration: none' href='?page=products&editmode=false2'><button type='button' class=\"form-control button_orange\" ><i class='fa fa-wrench'></i>  Bearbeitungsmodus deaktivieren</button></a><br>";
echo "</main>";

//In der Session gespeicherte Sucheingabe wird ausgelesen
$search = $_SESSION["search_save"];

//DB Verbindung
$db = new PDO($dsn, $dbuser, $dbpass);
$sql2 = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";
$query = $db->prepare($sql2);
$query->execute();

while ($zeile = $query->fetchObject()) {
    //DB Ergebnisse werden in Formulare geladen um sie zu bearbeiten
    echo "<div class='product_backend'>";
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2\" id='store_defined_backend'>";
    echo "<form action='./functions/backend/products/update_do.php' method='post' enctype='multipart/form-data'>";

    //Überprüft ob ein Bild vorhanden ist
    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    }
    else {
        echo "";
    }
    echo "<div class='desc_backend'>";
    echo "<span class='kategorie'>BILD</span><br>";
    echo "<input type='file' name='bild'/>";
    echo "<input type='hidden' name='ean' value='$zeile->ean' />";
    echo "<input type='hidden' name='oldbild' value='$zeile->bild' />";
    echo "<br><span class='kategorie'>PRODUKTNAME</span><br>";
    echo "<input class=\"form-control\" type='text' name='name' value='$zeile->name' />";
    echo "<span class='kategorie'>BESCHREIBUNG</span><br>";
    echo "<textarea class=\"form-control\" name='beschreibung' rows='10' cols='100'>$zeile->beschreibung</textarea>";
    echo "<span class='kategorie'>BEWERTUNG (0-100)</span><br>";
    echo "<input class=\"form-control\" type='number' min='0' max='100' name='rating' value='$zeile->rating' />";
    echo "<span class='kategorie'>PREIS (€)</span><br>";
    echo "<input class=\"form-control\" type='text' name='preis' value='$zeile->preis' />";
    echo "<span class='kategorie'>GENRE</span><br>";
    echo "<input class=\"form-control\" type='text' name='genre' value='$zeile->genre' />";
    echo "<input class=\"form-control button_orange\" type='submit' value='Bearbeiten' /><br>";
    echo "</form>";
    //Produkt löschen Button/Formular
    echo "<form action='./functions/backend/products/delete.php' method='post'>";
    echo "<input type='hidden' name='oldbild' value='$zeile->bild' />";
    echo "<input type='hidden' name='ean' value='$zeile->ean' />";
    echo "<input class=\"form-control button_red\" type='submit' value='Produkt löschen' />";
    echo "</form>";
    echo "</div></div>";
    echo "</main>";
}
