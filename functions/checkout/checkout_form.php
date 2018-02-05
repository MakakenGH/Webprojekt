<?php
session_start();

$username = $_SESSION['userid'];
setlocale(LC_MONETARY, 'de_DE');

echo "<br><span style='font-size: x-large;'><b>Bitte überpüfe deine Bestellung <span style='color: darkorange'> $username</span></b></span><br><br>";
echo "<div class='row'>";
echo "<div class='col' id='checkout'>";
echo "<div class='table-responsive'>";
echo "<table class='table'>";
echo "<thead><tr><th>Bild</th><th>Name</th></th><th>Anzahl</th><th>Einzelpreis</th><th>Gesamtpreis</th></tr></thead>";

$db = new PDO($dsn, $dbuser, $dbpass);

//DB Verbindung
$sqltable = "SELECT s.name, s.ean, s.bild, s.preis, c.anzahl, s.preis * c.anzahl as total FROM sortiment s, cart c WHERE s.ean = c.ean AND c.username ='".$username."'"; $preparedtable = $db->prepare($sqltable);
$preparedtable->execute();
$table = $preparedtable->fetchAll(PDO::FETCH_ASSOC);

//Artikel im Warenkorb werden ausgelesen
foreach ($table as $tablerow) {
    $artikelname = $tablerow['name'];
    $artikelbild = $tablerow['bild'];
    $artikelpreis = $tablerow['preis'];
    $gesamtpreis= $tablerow['total'];
    $anzahl = $tablerow['anzahl'];
    echo "<tbody>";
    echo "<tr>";
    echo "<td><img style='width: 200px; height: auto;' src='files/uploads/$artikelbild'></td>";
    echo "<td><b>$artikelname</b></td>";
    echo "<td>$anzahl</td>";
    echo "<td>".money_format('%.2n', (float)$artikelpreis)." €"."</td>";
    echo "<td>".money_format('%.2n', (float)$gesamtpreis)." €"."</td>";
    echo "</tr>";
    echo "</tbody>";
}

//DB Verbindung, Gesamtsumme der Bestellung wird ausgelesen
$sqltotal = "SELECT SUM(s.preis * c.anzahl) as totalSum FROM sortiment s, cart c WHERE c.ean = s.ean AND c.username = '".$username."'"; $preparedsum = $db->prepare($sqltotal);
$preparedsum->execute();
$totalsum = $preparedsum->fetchAll(PDO::FETCH_ASSOC);
$totalsumnumber = $totalsum[0]["totalSum"];

//Bestellsumme wird ausgegeben
echo "<tfoot>";
echo "<tr>";
echo "<td><b>BESTELLSUMME</b></td><td> </td><td> </td><td> </td>";
echo "<td><b>".money_format('%.2n',$totalsumnumber)." €"."</b></td>";
echo "</tr>";
echo "</tfoot>";
echo "</table>";
echo "</div>";
echo "Alle Preise enthalten die gesetzliche Mehrwertsteuer.<br><br>";
echo "</div>";
echo "<div class='col' id='checkout'>";

//E-Mail Feld wird eingefügt
require_once ('./functions/checkout/mail_form.php');
echo "</div>";
echo "</div>";
