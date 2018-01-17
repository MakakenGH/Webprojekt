<?php

include_once "./functions/db.php";

$search=htmlspecialchars($_POST["search"]);

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";

$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";
while ($zeile = $query->fetchObject()) {

    echo "<div class='col-sm-4' id='store_defined'>";
    echo "<h1>$zeile->name</h1> <br/><br/> \n";
    echo "$zeile->genre<br>";

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br><br> \n";
    }
    else {
        echo "";
    }

    echo "$zeile->beschreibung <br/><br/> \n";


    echo "PREIS: $zeile->preis / NUTZERWERTUNG: $zeile->rating <br><br>";
    echo "$zeile->ean";
    echo "</div>";
    }
echo "</div>";
?>
