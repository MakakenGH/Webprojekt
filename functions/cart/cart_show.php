<?php
session_start();

if (isset($_SESSION['userid'])) {

    $username = $_SESSION['userid'];

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = $db->query("SELECT ean,anzahl FROM cart WHERE username='" . $username."'");
$results = $sql->fetchAll();

foreach ($results as $eansingle) {
    $ean = $eansingle['ean'];
    $anzahl = $eansingle['anzahl'];

    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = $db->query("SELECT * FROM sortiment WHERE ean='".$ean."'");
    $query = $sql->fetch();

    $artikelname = $query['name'];
    $artikelbild = $query['bild'];
    $artikelpreis = $query['preis'];

    echo "<span>Anzahl: $anzahl</span>";
    echo "<span><img src='files/uploads/$artikelbild'></span>";
    echo "<br>";
    echo "<span><b>$artikelname</b></span>";
    echo "<br>";
    echo "<span><b>$artikelpreis</b></span>";
    echo "<br><br>";
    echo "<span>SUMME: </span>"
}

} else {

    $cart = $_SESSION['cart'];
    echo $cart[0][1];


    /*foreach ($results as $eansingle) {
        $ean = $eansingle['ean'];
        $anzahl = $eansingle['anzahl'];

    }*/
}