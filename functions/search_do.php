<?php

include_once "db.php";

$search=htmlspecialchars($_POST["search"]);

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";

$query = $db->prepare($sql);
$query->execute();


while ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->name</h1> <br/><br/> \n";
    echo "$zeile->genre<br>";

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img src='../files/uploads/$zeile->bild'/><br><br> \n";
    }
    else {
        echo "";
    }

    echo "$zeile->beschreibung <br/><br/> \n";


    echo "PREIS: $zeile->preis / NUTZERWERTUNG: $zeile->rating <br><br>";
    echo "$zeile->ean";
}

?>
