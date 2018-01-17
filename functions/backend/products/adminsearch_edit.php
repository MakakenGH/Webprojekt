<?php
session_start();
include_once("./functions/db.php");
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";

echo "<span><a href='?page=products&editmode=false2'>Bearbeitungsmodus deaktivieren</a></span><br>";
echo "</main>";
$search = $_SESSION["search_save"];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql2 = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";
$query = $db->prepare($sql2);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";

    echo "<form action='./functions/backend/products/update_do.php' method='post' enctype='multipart/form-data'>";
	    $bildlg = strlen($zeile->bild);
        if ($bildlg >= 1) {
            echo "<img src='./files/uploads/$zeile->bild'/><br>";
        }
        else {
            echo "";
        }
	    echo "<input type='file' name='bild'/><br>";
	    echo "<input type='hidden' name='ean' value='$zeile->ean' />";
		echo "<input type='hidden' name='oldbild' value='$zeile->bild' />";
        echo "<br><input type='text' name='name' value='$zeile->name' /><br>";
	    echo "<textarea name='beschreibung' rows='10' cols='100'>$zeile->beschreibung</textarea><br>";
	    echo "<br><input type='number' min='0' max='100' name='rating' value='$zeile->rating' /><br>";
	    echo "<br><input type='text' name='preis' value='$zeile->preis' /><br>";
	    echo "<br><input type='text' name='genre' value='$zeile->genre' /><br>";
        echo "<input type='submit' value='bearbeiten' /><br><br>";
        echo "</form>";
        echo "<form action='./functions/backend/products/delete2.php' method='post'>";
        echo "<input type='hidden' name='oldbild' value='$zeile->bild' />";
        echo "<input type='hidden' name='ean' value='$zeile->ean' />";
        echo "<input type='submit' value='Produkt löschen' /><br><br>";
        echo "</main>";
}
