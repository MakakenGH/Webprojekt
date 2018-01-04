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


$recipient = $email;

$min = 1000;
$max = 9999;
$key_part1 = rand ($min ,$max);
$key_part2 = rand ($min ,$max);
$key_part3 = rand ($min ,$max);

$key = $key_part1.'-'.$key_part2.'-'.$key_part3;

$time = date("d-m-Y H:i:s");
echo $time;

$subject = "Dein Kauf bei Dampf!";
$from = "From: Dampf! <dampf@hdm-stuttgart.de>";
$text = ("
Vielen Dank für deinen Kauf bei Dampf!

Hier ist dein Key: $key

Auftragsdatum: $time
Bestellnummer: $order_number


Diese E-Mail dient als Deine Einkaufsbestätigung.

Dampf! 
Nobelstraße 10 
70569 Stuttgart
Vertreten durch:
Niklas Fath|Thomas Roglmeier|Tolga Sevim
Umsatzsteuer-ID:123456789 
Wirtschafts-ID: 987654321

");

mail($recipient, $subject, $text, $from);
