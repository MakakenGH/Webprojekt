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
    echo "<div class='product_backend'>";
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2\" id='store_defined_backend'>";

    echo "<form action='./functions/backend/products/update_do.php' method='post' enctype='multipart/form-data'>";
	    $bildlg = strlen($zeile->bild);
        if ($bildlg >= 1) {
            echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
        }
        else {
            echo "";
        }
        echo "<div class='desc_backend'>";
	    echo "<input type='file' name='bild'/><br>";
	    echo "<input type='hidden' name='ean' value='$zeile->ean' />";
		echo "<input type='hidden' name='oldbild' value='$zeile->bild' />";
        echo "<input class=\"form-control\" type='text' name='name' value='$zeile->name' />";
	    echo "<textarea class=\"form-control\" name='beschreibung' rows='10' cols='100'>$zeile->beschreibung</textarea>";
	    echo "<input class=\"form-control\" type='number' min='0' max='100' name='rating' value='$zeile->rating' />";
	    echo "<input class=\"form-control\" type='text' name='preis' value='$zeile->preis' />";
	    echo "<input class=\"form-control\" type='text' name='genre' value='$zeile->genre' />";
        echo "<input class=\"form-control button_orange\" type='submit' value='bearbeiten' /><br>";
        echo "</form>";
        echo "<form action='./functions/backend/products/delete2.php' method='post'>";
        echo "<input type='hidden' name='oldbild' value='$zeile->bild' />";
        echo "<input type='hidden' name='ean' value='$zeile->ean' />";
        echo "<input class=\"form-control button_red\" type='submit' value='Produkt löschen' />";
        echo "</form>";
        echo "</div></div>";
        echo "</main>";
}
