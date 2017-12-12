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
    echo "<form action='functions/cart/cart_delete.php' method='post'><input type='hidden' value='$ean' name='ean'><input type='submit' class='button_orange' value='Löschen'></form>";
    echo "<br><br>";
}

    $sum = 0;

    foreach($results as $num => $values) {
        $sum += $values['preis'];
        echo $sum;
    }

} else {

   /* $cart = $_SESSION['cart'];

    foreach ($cart as $products) {
        foreach ($products as $eansingle2) {
            echo $eansingle2;
        }

    }*/
}