<?php
include_once ("../db.php");
include_once ("../../widgets/navigation.php");
$ean = $_GET["ean"];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE ean=$ean";
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


} else {
    print "Datensatz mit id=$id nicht gefunden!";
}
$db = null;
?>

    <form action="rate_do.php" method="post">
        <input type="text" size="40" maxlength="250" name="rate" placeholder="Bewertung"><br>
        <input type="hidden" size="40" name="ean" value="<?php echo $ean; ?>"><br>
        <input type="submit" value="Abschicken">
    </form>
<?php
include_once ("../../widgets/footer.php");
?>