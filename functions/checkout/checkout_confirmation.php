<?php
session_start();
include_once ('../db.php');

$username = $_SESSION['userid'];

//Verbindung mit Bestellungen/orders DB
$db = new PDO($dsn, $dbuser, $dbpass);
//Läd die letzte Bestellung des Nutzers aus der DB
$statement = $db->prepare("SELECT * FROM orders WHERE username = '".$username."' ORDER BY datetime DESC");
$statement->execute();

//Läd die Bestellnummer und Email
if ($zeile = $statement->fetchObject()) {
    $order_number = $zeile->order_number;
    $email = $zeile->email;
}

//Verbindung mit Orders und Sortiment DB um Produktinformationen zu bestellten Produkten zu erhalten
$statement2 = $db->prepare("SELECT s.name, o.sum_total, o.anzahl, o.username, o.sale_price, o.payment FROM orders o, sortiment s WHERE o.ean = s.ean AND o.order_number = '".$order_number."'");
$statement2->execute();

$recipient = $email;

//Verbindung mit Nutzer DB um echten Namen zu erhalten
$statement3 = $db->prepare("SELECT name FROM users WHERE username = '".$username."'");
$statement3->execute();

if ($zeile3 = $statement3->fetchObject()) {
    $name = $zeile3->name;
}


$time = date("d-m-Y H:i:s"); //Datum Format
$totalamount = 0;
$totalprice = 0;
$amount = 0;

//E-Mail wird aufgebaut
$mailtext = "<html>";
$mailtext .= "<head>";
$mailtext .= "<meta charset=\"UTF-8\">";
$mailtext .= "</head>";
$mailtext .= "<body>";
$mailtext .= "<img src='https://raw.githubusercontent.com/MakakenGH/Webprojekt/master/files/uploads/logo_small.png'/>";
$mailtext .= "<h2>Vielen Dank für deinen Einkauf bei Dampf!</h2>";
$mailtext .= "<p>Hallo ".$name.",</p>";
$mailtext .= "<p>du hast kürzlich bei Dampf! folgendes bestellt: </p>";
$mailtext .= "<table>";
$mailtext .= "<thead><tr><th>Anzahl</th><th>Artikelname</th><th>Einzelpreis</th></th><th>Gesamtsumme</th><th>Deine Keys</th></tr></thead>";

$mailtext .= "<tbody>";

//Ausgabe der bestellten Artikel
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
    //Generierung der Keys
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
    $zahlungsmethode = $zeile2->payment;
}


$mailtext .= "</tbody>";
$mailtext .= "<tfoot>";
$mailtext .= "<tr>";
$mailtext .= "<td><b>BESTELLSUMME</b></td><td> </td><td> </td>";
$mailtext .= "<td><b>$totalprice €</b></td>";
$mailtext .= "</tr>";
$mailtext .= "</tfoot>";
$mailtext .= "</table><br>";
$mailtext .= "<p>Im Rechnungsbetrag sind 19 % MwSt enthalten.<br><br></p>";
$mailtext .= "<p><b>Zahlungsmethode: </b>".$zahlungsmethode."</p>";
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

//E-Mail wird abgeschickt
mail($recipient, $subject, $mailtext, $from);

header("Location: ../../index.php?page=thankyou");



