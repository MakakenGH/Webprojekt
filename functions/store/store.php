<?php
session_start();
include_once("./functions/db.php");

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment ORDER BY rating DESC";
$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";
while ($zeile = $query->fetchObject()) {

    echo "<div class='col-sm-4'>";
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "<span><b>$zeile->name</b></span><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span><br>";
    echo "<span><a href='index.php?ean=$zeile->ean'>Zur Produktseite</a></span><br>";
    if (isset($_SESSION['userid'])) {
        echo "<span><a href='./functions/cart/cartupdate_do.php?ean=$zeile->ean'>In den Warenkorb legen</a></span>";}
        else {
        echo "<form action='../cart/cartupdatenologin_do.php' method='post'><input type='hidden' value='<?php echo ($zeile->ean); ?>'><input type='submit' value='In den Warenkorb legen'></form>";
    }
    echo "</div><br><br>";}
echo "</div>";
?>
