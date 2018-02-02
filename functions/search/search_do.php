<?php

include_once "./functions/db.php";

$search=htmlspecialchars($_GET["search"]);

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";

$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";

if ($query->rowCount() > 0) {


    while ($zeile = $query->fetchObject()) {

        echo "<div class='col-sm-4' id='store_defined'>";
        echo "<a href='?ean=$zeile->ean'>";
        echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
        echo "</a>";
        echo "<div class='store_text'>";
        echo" <button type=\"button\" class=\"btn btn-info\" data-toggle=\"collapse\" data-target=\"#demo\">Beschreibung</button>";
        echo "<span><b>$zeile->name</b></span><br>";
        echo "<div id='demo' class='collapse'>";
        echo "<span id='beschreibung_store'>$zeile->beschreibung</span><br></div>";
        echo "<span>$zeile->rating</span><br>";
        echo "<span class='price_store'>$zeile->preis</span><br>";
        echo "<form action='./functions/cart/cartupdate_do.php' method='get'><input type='hidden' value='$zeile->ean' name='ean'><input type='number' min='0' value='1' style='max-width: 50px' name='anzahl'>&nbsp;<input type='submit' class='button_orange' value='In den Warenkorb legen'></form>";
        echo "</div></div><br><br><br>";}
}
else {
    echo "Suchergebnis erfolglos";
}

echo "</div>";
?>
