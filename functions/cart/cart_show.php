<?php
session_start();


if (isset($_SESSION['userid'])) {

    $username = $_SESSION['userid'];
    setlocale(LC_MONETARY, 'de_DE');

    $db = new PDO($dsn, $dbuser, $dbpass);

    $sql_check = "SELECT * FROM cart WHERE username='".$username."'";
    $query = $db->prepare($sql_check);
    $query->execute();

    if ($query->fetchAll()) {

        echo "<span style='font-size: xx-large'>Hier ist dein Warenkorb <b style='color: darkorange;'>$username</b>:</span><br><br>";

        echo "<div class='table-responsive'>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Bild</th><th>Name</th><th>EAN</th></th><th>Anzahl</th><th>Einzelpreis</th><th>Gesamtpreis</th><th>Löschen</th></tr></thead>";



        $sqltable = "SELECT s.name, s.ean, s.bild, s.preis, c.anzahl, s.preis * c.anzahl as total FROM sortiment s, cart c WHERE s.ean = c.ean AND c.username ='" . $username . "'";
        $preparedtable = $db->prepare($sqltable);
        $preparedtable->execute();
        $table = $preparedtable->fetchAll(PDO::FETCH_ASSOC);

        foreach ($table as $tablerow) {

            $artikelname = $tablerow['name'];
            $artikelbild = $tablerow['bild'];
            $artikelpreis = $tablerow['preis'];
            $gesamtpreis = $tablerow['total'];
            $anzahl = $tablerow['anzahl'];
            $ean = $tablerow['ean'];

            echo "<tbody>";
            echo "<tr>";
            echo "<td><img style='width: 200px; height: auto;' src='files/uploads/$artikelbild'></td>";
            echo "<td><b>$artikelname</b></td>";
            echo "<td>$ean</td>";
            echo "<td>$anzahl</td>";
            echo "<td>" . money_format('%.2n', (float)$artikelpreis) . " €" . "</td>";
            echo "<td>" . money_format('%.2n', (float)$gesamtpreis) . " €" . "</td>";
            echo "<td><form action='functions/cart/cart_delete.php' method='post'><input type='hidden' value='$ean' name='ean'>
                <input style='max-width: 50px;' type='number' value='1' name='anzahl' min='0'><input type='submit' class='button_orange' value='Löschen'></form></td>";
            echo "</tr>";
            echo "</tbody>";

        }
        $sqltotal = "SELECT SUM(s.preis * c.anzahl) as totalSum FROM sortiment s, cart c WHERE c.ean = s.ean AND c.username = '" . $username . "'";
        $preparedsum = $db->prepare($sqltotal);
        $preparedsum->execute();
        $totalsum = $preparedsum->fetchAll(PDO::FETCH_ASSOC);
        $totalsumnumber = $totalsum[0]["totalSum"];

        echo "<tfoot>";
        echo "<tr>";
        echo "<td><b>BESTELLSUMME</b></td><td> </td><td> </td><td> </td><td> </td>";
        echo "<td><b>" . money_format('%.2n', $totalsumnumber) . " €" . "</b></td>";
        echo "<td><a href='?page=checkout'><button class='button_orange'><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Zur Kasse</button></a><br>
                <br><a href='?page=store&action=store'><button class='button_shoppen'><i class=\"fa fa-gamepad\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Weiter Shoppen</button></a></td>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='col-md-3 col-centered text-center log_window'>Dein Warenkorb ist noch leer <span style='color: darkorange'> $username</span>. Hier gehts zum Store. <br><br> <a href='?page=store&action=store'><button class='button_orange'>zum Store</button></a></div>";

    }
} else {

    echo "<div class='col-md-3 col-centered text-center log_window'>Um diese Funktion nutzen zu können logge dich bitte ein.<br><br> <a href='?page=users&action=login'><button class='button_orange'>zum Login</button></a></div>";
}
