<?php
try {
    //DB Verbindung, liest Bewertungen von eingelogtem User zu entsprechendem Produkt aus
    $db4 = new PDO($dsn, $dbuser, $dbpass);
    $sql4 = "SELECT * FROM userrating WHERE ean='".$ean."' AND username='".$username."'";
    $query4 = $db4->prepare($sql4);
    $query4->execute();
    if ($zeile4 = $query4->fetchObject()) {
        echo "<form action='./functions/products/rateupdate_do.php' method='post'>";
        echo "<input type='hidden' name='ean' value='$zeile4->ean'/>";
        echo "<input type='hidden' name='username' value='$zeile4->username'/>";
        echo "<span class='kategorie'>KOMMENTAR</span><br>";
        echo "<textarea class=\"form-control\" name='comment' rows='4' cols='20'>$zeile4->comment</textarea>";
        echo "<span class='kategorie'>BEWERTUNG (0-100)</span><br>";
        echo "<input class=\"form-control\" type='number' name='rating' min=\"0\" max=\"100\" value='$zeile4->rating' /><br>";
        echo "<input class=\"form-control button_orange\" type='submit' value='Bearbeiten' />";
        echo "</form>";
    } else {
        echo "Error";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!";
    die();
}

?>