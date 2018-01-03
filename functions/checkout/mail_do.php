<?php
session_start();
 $new_email = $_POST["new_email"];
 $user_email = $_POST["user_email"];

 echo $user_email;
 if(isset($user_email)) {
     $recipient = $user_email;
 }
 else {
     $recipient = $new_email;
 }
 echo $recipient;

$min = 1000;
$max = 9999;
$key_part1 = rand ($min ,$max);
$key_part2 = rand ($min ,$max);
$key_part3 = rand ($min ,$max);

$key = $key_part1.'-'.$key_part2.'-'.$key_part3;

$billnumber = rand ($min ,$max);
$time = date("d-m-Y H:i:s");
echo $time;

$subject = "Dein Kauf bei Dampf!";
$from = "From: Dampf! <dampf@hdm-stuttgart.de>";
$text = ("
Vielen Dank für deinen Kauf bei Dampf!

Hier ist dein Key: $key

Auftragsdatum: $time
Rechnungsnummer: $billnumber


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
?>