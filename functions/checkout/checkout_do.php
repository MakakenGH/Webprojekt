<!-- Kasse -->
<?php
session_start();
include_once ('../db.php');

//Überprüft ob Nutzer eingeloggt ist
if (isset($_SESSION['userid'])) {

    $username = $_SESSION['userid'];

    $new_email = $_POST["new_email"];
    $user_email = $_POST["user_email"];

    $zahlungsmethode = $_POST['Zahlmethode'];

    //Wenn Nutzer eingeloggt ist wird die gespeicherte E-Mail genutzt wenn nicht dann die neue E-Mail
    if(isset($user_email)) {
        $email = $user_email;
    }
    else {
        $email = $new_email;
    }
    //Setzt deutsche Währung und Schreibweise als Standard
    setlocale(LC_MONETARY, 'de_DE');

    $db = new PDO($dsn, $dbuser, $dbpass);

    //DB Verbindung, liest die Arikel aus dem Warenkorb aus
    $sqltable = "SELECT s.name, s.ean, s.bild, s.preis, c.anzahl, s.preis * c.anzahl as total FROM sortiment s, cart c WHERE s.ean = c.ean AND c.username ='".$username."'";
    $preparedtable = $db->prepare($sqltable);
    $preparedtable->execute();
    $table = $preparedtable->fetchAll(PDO::FETCH_ASSOC);

    //Bestellnummer wird generiert
    $min = 1;
    $max = 9999;
    $order_number = rand ($min ,$max); //Erstellt eine Zufallszahl zwischen $min und $max

    foreach ($table as $tablerow) {
        $artikelname = $tablerow['name'];
        $artikelbild = $tablerow['bild'];
        $artikelpreis = $tablerow['preis'];
        $gesamtpreis= $tablerow['total'];
        $anzahl = $tablerow['anzahl'];
        $ean = $tablerow['ean'];

        //Speichert Produkte aus dem Warenkorb in die Bestellungen Tabelle der DB
        $statement = $db->prepare("INSERT INTO orders (order_number, ean, anzahl, username, email, sale_price, sum_total, payment) VALUES (:order_number, :ean, :anzahl, :username, :email, :sale_price, :sum_total, :payment)");
        $statement->execute(array('order_number' => $order_number, 'ean' => $ean, 'anzahl'=> $anzahl, 'username' => $username, 'email' => $email, 'sale_price' => $artikelpreis, 'sum_total' => $gesamtpreis, 'payment' => $zahlungsmethode));

        //Löscht Inhalte der Warenkorb Tabelle
        $statement2 = $db->prepare("DELETE FROM cart WHERE username = '".$username."'");
        $statement2->execute();
    }

    //Errechnet die Gesamtsumme der Bestellung
    $sqltotal = "SELECT SUM(s.preis * c.anzahl) as totalSum FROM sortiment s, cart c WHERE c.ean = s.ean AND c.username = '".$username."'";
    $preparedsum = $db->prepare($sqltotal);
    $preparedsum->execute();
    $totalsum = $preparedsum->fetchAll(PDO::FETCH_ASSOC);
    $totalsumnumber = $totalsum[0]["totalSum"];
    //Öffnet die Datei zur E-Mail Bestellbestätigung
    header("Location: checkout_confirmation.php");

} else {

    echo "<div>Um diese Funktion nutzen zu können loggen Sie sich bitte ein.<br> <a href='?page=users&action=login'><button class='button_orange'>zum Login</button></a></div>";

}