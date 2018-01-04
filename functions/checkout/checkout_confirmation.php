<?php
session_start();
include_once ('../db.php');
/*email bestätigung*/
$username = $_SESSION['userid'];
$db = new PDO($dsn, $dbuser, $dbpass);

$statement = $db->prepare("SELECT * FROM orders WHERE username = '".$username."' ORDER BY datetime DESC");
$statement->execute();

if ($zeile = $statement->fetchObject()) {
    $order_number = $zeile->order_number;
    $email = $zeile->email;
}

$statement2 = $db->prepare("SELECT s.name, o.sum_total, o.anzahl, o.username, o.sale_price FROM orders o, sortiment s WHERE o.ean = s.ean AND o.order_number = '".$order_number."'");
$statement2->execute();

$recipient = $email;



$time = date("d-m-Y H:i:s");
echo $time;
$totalamount = 0;
$totalprice = 0;
$amount = 0;

$mailtext = "<html><body>";
$mailtext .= "<img src='https://raw.githubusercontent.com/MakakenGH/Webprojekt/master/files/uploads/logo_small.png'/>";
$mailtext .= "<h2>Vielen Dank für deinen Einkauf bei Dampf!</h2>";
$mailtext .= "<p>Hallo ".$username.",</p>";
$mailtext .= "<p>du hast kürzlich bei Dampf! folgendes bestellt: </p>";
$mailtext .= "<table>";
$mailtext .= "<thead><tr><th>Anzahl</th><th>Artikelname</th><th>Einzelpreis</th></th><th>Gesamtsumme</th><th>Deine Keys</th></tr></thead>";

$mailtext .= "<tbody>";

while ($zeile2 = $statement2->fetchObject()) {

    $amount = $zeile2->anzahl;
    $mailtext .= "<tr>";
    $mailtext .= "<td>";
    $mailtext .= $zeile2->anzahl;
    $mailtext .= "</td>";
    $mailtext .= "<td>";
    $mailtext .= $zeile2->name;
    $mailtext .= "</td>";
    $mailtext .= "<td>";
    $mailtext .= $zeile2->sale_price ."€";
    $mailtext .= "</td>";
    $mailtext .= "<td>";
    $mailtext .= $zeile2->sum_total ."€";
    $mailtext .= "</td>";
    $mailtext .= "<td>";
    for ($i = 0; $i < $amount; $i++) {
        $min = 1000;
        $max = 9999;
        $key_part1 = rand ($min ,$max);
        $key_part2 = rand ($min ,$max);
        $key_part3 = rand ($min ,$max);
        $key = $key_part1.'-'.$key_part2.'-'.$key_part3;

        $mailtext .= "$key<br>";
    };
    $mailtext .= "<br>";
    $mailtext .= "</td>";
    $mailtext .= "</tr>";
    $totalprice += $zeile2->sum_total;
}


$mailtext .= "</tbody>";
$mailtext .= "<tfoot>";
$mailtext .= "<tr>";
$mailtext .= "<td><b>BESTELLSUMME</b></td><td> </td><td> </td>";
$mailtext .= "<td><b>$totalprice €</b></td>";
$mailtext .= "</tr>";
$mailtext .= "</tfoot>";
$mailtext .= "</table><br>";
$mailtext .= "<p><b>Bestellnummer: </b>".$order_number."</p>";
$mailtext .= "<p><b>Auftragsdatum: </b>".$time."</p>";
$mailtext .= "<br><h3>Bis zum nächsten Mal! -Team Dampf</h3>";
$mailtext .= "<br><p>

Diese E-Mail dient als Deine Einkaufsbestätigung.<br><br>

Dampf!<br> 
Nobelstraße 10 <br>
70569 Stuttgart<br>
Vertreten durch:<br>
Niklas Fath|Thomas Roglmeier|Tolga Sevim<br>
Umsatzsteuer-ID:123456789 <br>
Wirtschafts-ID: 987654321<br>
</p>";

$subject = "Dein Einkauf bei Dampf!";
$from = "From: Dampf! <dampf@hdm-stuttgart.de>\n";
$from .= "Reply-To: noreply@hdm-stuttgart.de\n";
$from .= "Content-Type: text/html\n";


mail($recipient, $subject, $mailtext, $from);



