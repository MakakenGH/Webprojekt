<?php
session_start();
include_once ('../db.php');
if (isset($_SESSION['userid'])) {

    $username = $_SESSION['userid'];

    $new_email = $_POST["new_email"];
    $user_email = $_POST["user_email"];

    if(isset($user_email)) {
        $email = $user_email;
    }
    else {
        $email = $new_email;
    }
    setlocale(LC_MONETARY, 'de_DE');

    $db = new PDO($dsn, $dbuser, $dbpass);

    $sqltable = "SELECT s.name, s.ean, s.bild, s.preis, c.anzahl, s.preis * c.anzahl as total FROM sortiment s, cart c WHERE s.ean = c.ean AND c.username ='".$username."'";
    $preparedtable = $db->prepare($sqltable);
    $preparedtable->execute();
    $table = $preparedtable->fetchAll(PDO::FETCH_ASSOC);
    $min = 1;
    $max = 9999;
    $order_number = rand ($min ,$max);

    foreach ($table as $tablerow) {

        $artikelname = $tablerow['name'];
        $artikelbild = $tablerow['bild'];
        $artikelpreis = $tablerow['preis'];
        $gesamtpreis= $tablerow['total'];
        $anzahl = $tablerow['anzahl'];
        $ean = $tablerow['ean'];

        $statement = $db->prepare("INSERT INTO orders (order_number, ean, anzahl, username, email, sale_price, sum_total) VALUES (:order_number, :ean, :anzahl, :username, :email, :sale_price, :sum_total)");
        $statement->execute(array('order_number' => $order_number, 'ean' => $ean, 'anzahl'=> $anzahl, 'username' => $username, 'email' => $email, 'sale_price' => $artikelpreis, 'sum_total' => $gesamtpreis));

        $statement2 = $db->prepare("DELETE FROM cart WHERE username = '".$username."'");
        $statement2->execute();
    }
    $sqltotal = "SELECT SUM(s.preis * c.anzahl) as totalSum FROM sortiment s, cart c WHERE c.ean = s.ean AND c.username = '".$username."'";
    $preparedsum = $db->prepare($sqltotal);
    $preparedsum->execute();
    $totalsum = $preparedsum->fetchAll(PDO::FETCH_ASSOC);
    $totalsumnumber = $totalsum[0]["totalSum"];
    header("Location: checkout_confirmation.php");

} else {

    echo "<div>Um diese Funktion nutzen zu können loggen Sie sich bitte ein.<br> <a href='?page=users&action=login'><button class='button_orange'>zum Login</button></a></div>";

}

