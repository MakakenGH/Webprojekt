<?php
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";

session_start();
include_once("./functions/db.php");

$db = new PDO($dsn, $dbuser, $dbpass);

$sqlorders = "SELECT o.id, o.order_number, o.ean, o.anzahl , o.sale_price, o.sum_total, o.datetime, s.name FROM orders o, sortiment s WHERE s.ean = o.ean";//sagen der Datenbank was wir sagen wollen
$preparedorders = $db->prepare($sqlorders);//Befehl wird vorbereitet
$preparedorders->execute();//wird ausgeführt
$orders = $preparedorders->fetchAll();//Alle Daten sind jetzt im $ordersrow gespeichert

echo "<div class='table-responsive'>";
echo "<table class='table_orders'>";
echo "<thead><tr><th>Order-ID</th><th>Order-Number</th><th>EAN</th><th>Name</th><th>Anzahl</th><th>Verkaufspreis</th><th>Gesamtpreis</th><th>Bestelldatum</th></thead>";


foreach ($orders as $ordersrow) {

    $id = $ordersrow['id'];
    $order_number = $ordersrow['order_number'];
    $ean = $ordersrow['ean'];
    $anzahl = $ordersrow['anzahl'];
    $sale_price = $ordersrow['sale_price'];
    $sumtotal=$ordersrow ['sum_total'];
    $datetime = $ordersrow['datetime'];
    $name= $ordersrow['name'];

    echo "<tbody>";
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$order_number</td>";
    echo "<td>$ean</td>";
    echo "<td>$name</td>";
    echo "<td>$anzahl</td>";
    echo "<td>".money_format('%.2n', (float)$sale_price)." €"."</td>";
    echo "<td>".money_format('%.2n', (float)$sumtotal)." €"."</td>";
    echo "<td>$datetime</td>";

    echo "</tr>";
    echo "</tbody>";

}

echo "</table>";
echo "</div>";


echo "</main>";
?>

