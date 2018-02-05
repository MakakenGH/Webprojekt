<!--Die Auflistung der bestellen Artikel werden im Backend für die Admins angezeigt. -->
<?php
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\">";

session_start();
include_once("./functions/db.php");

//Datankbank verbindung wird aufgebaut!
$db = new PDO($dsn, $dbuser, $dbpass);

// Datenbankanfrage für die bestellten Produkte mit der Ausgabe im Backend.
$sqlorders = "SELECT o.id, o.order_number, o.ean, o.anzahl , o.sale_price, o.sum_total, o.payment, o.username,o.email, o.datetime, s.name FROM orders o, sortiment s WHERE s.ean = o.ean ORDER BY datetime DESC ";
$preparedorders = $db->prepare($sqlorders);//Befehl wird vorbereitet
$preparedorders->execute();//wird ausgeführt
$orders = $preparedorders->fetchAll();//Alle Daten sind jetzt im $ordersrow gespeichert

//Die Ausgabe wird in Form einer Tabelle ausgegeben.
echo "<div class='table-responsive'>";
echo "<table id='table_backend'>";
echo "<thead><tr><th>Order-ID</th><th>Order-Number</th><th>EAN</th><th>Game</th></th><th>Anzahl</th><th>Username</th><th>Verkaufspreis</th><th>Gesamtpreis</th><th>Bestelldatum</th><th>Bezahlart</th></thead>";

//Ergebnisse der Datenbankabfrage werden im Array gespeichert.
foreach ($orders as $ordersrow) {
    //Die Werte des Arrays werden Variablen zugewiesen.
    $id = $ordersrow['id'];
    $order_number = $ordersrow['order_number'];
    $ean = $ordersrow['ean'];
    $anzahl = $ordersrow['anzahl'];
    $username = $ordersrow['username'];
    $sale_price = $ordersrow['sale_price'];
    $sumtotal=$ordersrow ['sum_total'];
    $datetime = $ordersrow['datetime'];
    $payment = $ordersrow['payment'];
    $name= $ordersrow['name'];
//Die Variablen werden in Form einer Tabelle ausgegeben.
    echo "<tbody class='table_orders'>";
    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$order_number</td>";
    echo "<td>$ean</td>";
    echo "<td>$name</td>";
    echo "<td>$anzahl</td>";
    echo "<td>$username</td>";
    echo "<td>".money_format('%.2n', (float)$sale_price)." €"."</td>";
    echo "<td>".money_format('%.2n', (float)$sumtotal)." €"."</td>";
    echo "<td>$datetime</td>";
    echo "<td>$payment</td>";
    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";
echo "</div>";
echo "</main>";
?>

