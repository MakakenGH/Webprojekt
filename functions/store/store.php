<?php
include_once("./functions/db.php");

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment ORDER BY rating DESC";
$query = $db->prepare($sql);
$query->execute();

while ($zeile = $query->fetchObject()) {
    echo "<div>";
    echo "<img src='./files/uploads/$zeile->bild'/>&nbsp;";
    echo "<span><b>$zeile->name</b></span>&nbsp;";
    echo "<span>$zeile->beschreibung</span>&nbsp;";
    echo "<span>$zeile->rating</span>&nbsp;";
    echo "<span>$zeile->preis</span>&nbsp;";
    echo "<span><a href='./functions/products/product.php?ean=$zeile->ean'>Zur Produktseite</a></span><br>"; //nacher ersetzen mit div
    echo "<span><a href='./functions/cart/cartupdate_do.php?ean=$zeile->ean'>In den Warenkorb legen</a></span>";
    echo "</div><br><br>";

}
?>
