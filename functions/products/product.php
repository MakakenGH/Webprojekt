<?php
include_once ("../db.php");
include_once ("../../widgets/navigation.php");
$ean = (int)$_GET["ean"];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->name</h1> <br/><br/> \n";

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img src='../../files/uploads/$zeile->bild'/><br><br> \n";
    }
    else {
        echo "";
    }

    echo "$zeile->beschreibung <br/><br/> \n";


    echo "PREIS: $zeile->preis / NUTZERWERTUNG: $zeile->rating";
} else {
    print "Datensatz mit id=$id nicht gefunden!";
}
$db = null;

include_once ("../../widgets/footer.php");
?>