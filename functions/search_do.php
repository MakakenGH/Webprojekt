<?php

include_once "db.php";

$search=$_POST["search"];

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE name=$search";

$query = $db->prepare($sql);
$query->execute();

if ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->name</h1> <br/><br/> \n";
    echo "$zeile->genre<br>";

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img src='../../files/uploads/$zeile->bild'/><br><br> \n";
    }
    else {
        echo "";
    }

    echo "$zeile->beschreibung <br/><br/> \n";


    echo "PREIS: $zeile->preis / NUTZERWERTUNG: $zeile->rating <br><br>";
    echo "$zeile->ean";
}
else

    echo "Produkt nicht gefunden";
?>
