<?php

include_once "./functions/db.php";

$search=htmlspecialchars($_GET["search"]);

$db = new PDO($dsn, $dbuser, $dbpass);

$sql = "SELECT * FROM sortiment WHERE genre  LIKE  '%".$search."%' OR name LIKE '%".$search."%'";

$query = $db->prepare($sql);
$query->execute();
echo "<div class='col-sm-12'>";
echo "<h2>Suchergebnisse für: <span style='color: darkorange'>$search</span></h2>";
echo "</div>";
echo "<div class='row'>";
if ($query->rowCount() > 0)
{
while ($zeile = $query->fetchObject()) {
    echo "<div class='col-sm-4' id='store_defined'>";
    echo "<a href='?ean=$zeile->ean'>";
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "</a>";
    echo "<div class='store_text'>";
    echo "<a class='store_link' href='?ean=$zeile->ean'>";
    echo "<span style='font-size:xx-large'><b>$zeile->name</b></span><br><br>";
    echo "</a>";
    echo "<div class= 'row trenn'>";
    echo "<div class='col-sm-4 '>";
    echo "<span class='kategorie'>GENRE<br> </span><span class='search_ausgabe'>$zeile->genre</span> <br></div>";
    echo "<div class='col-sm-4'>";
    echo "<span class='kategorie'> BEWERTUNG <br></span> <span class='search_ausgabe'> $zeile->rating</span> <br><br></div>";
    echo "<div class='col-sm-4'>";
    echo "<span class='kategorie'> PREIS<br> </span><span class='search_ausgabe'> $zeile->preis €</span><br><br></div></div>";

    if (isset($_SESSION['userid'])) {
        echo "<form action='./functions/cart/cartupdate_do.php' method='get'>";
        echo "<input type='hidden' value='$zeile->ean' name='ean'>";
        echo "<div class='row'>";
        echo "<div class='col-sm-3'>";
        echo "<input class='form-control' type='number' min='0' value='1' name='anzahl'>";
        echo "</div>";
        echo "<div class='col-sm-9'>";
        echo "<input type='submit' class='form-control button_orange' value='In den Warenkorb legen'></div></div></form>";
    }
    else {
        echo "<div class='form-control text-center button_gray'><i class=\"fa fa-shopping-basket\" aria-hidden=\"true\"></i> In den Warenkorb legen (<a href='?page=users&action=login'>Bitte zuerst einloggen!)</a></div>";
    }
    echo "</div></div><br><br><br>";}
echo "</div>";
}
else {
    echo "<div class='col-centered log_window' > Suche erfolglos</div>";
}
echo "</div>";
?>
