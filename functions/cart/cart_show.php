<?php
session_start();

if (isset($_SESSION['userid'])) {

    $username = $_SESSION['userid'];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = $db->query("SELECT ean,anzahl FROM cart WHERE username='" . $username."'");
$results = $sql->fetchAll();

    echo "<div class='table-responsive'>";
    echo "<table class='table'>";
    echo "<thead><tr><th>Bild</th><th>Name</th><th>Anzahl</th><th>Einzelpreis</th><th>Gesamtpreis</th><th>Löschen</th></tr></thead>";

foreach ($results as $eansingle) {
    $ean = $eansingle['ean'];
    $anzahl = $eansingle['anzahl'];

    $db = new PDO($dsn, $dbuser, $dbpass);

    $sqltable = "SELECT s.name, s.bild, s.preis, s.preis * c.anzahl as total FROM sortiment s, cart c WHERE ean='".$ean."'";
    $preparedtable = $db->prepare($sqltable);
    $preparedtable->execute();
    $query = $preparedtable->fetchAll(PDO::FETCH_ASSOC);

    $artikelname = $query['name'];
    $artikelbild = $query['bild'];
    $artikelpreis = $query['preis'];
    $gesamtpreis= $query2['total'];

    echo "<tbody>";
    echo "<tr>";
    echo "<td><img style='width: 200px; height: auto;' src='files/uploads/$artikelbild'></td>";
    echo "<td><b>$artikelname</b></td>";
    echo "<td>$anzahl</td>";
    echo "<td><b>$artikelpreis</b></td>";
    echo "<td><b>$gesamtpreis</b></td>";
    echo "<td><form action='functions/cart/cart_delete.php' method='post'><input type='hidden' value='$ean' name='ean'><input type='submit' class='button_orange' value='Löschen'></form></td>";
    echo "</tr>";
    echo "</tbody>";

}
    echo "</table>";
    echo "</div>";

    $sqltotal = $db->query('SELECT SUM(s.price * c.anzahl) as totalSum FROM sortiment s, cart c WHERE c.ean = s.ean AND c.username = "'.$username.'"');
    $totalsum = $sqltotal->fetchAll(PDO::FETCH_ASSOC);
    echo money_format('%.2n', $totalsum[0]["totalSum"]);

} else {

    echo "<div>Um diese Funktion nutzen zu können loggen Sie sich bitte ein.<br> <a href='?page=users&action=login'><button class='button_orange'>zum Login</button></a></div>";

    }
