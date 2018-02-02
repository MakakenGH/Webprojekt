<?php
session_start();

//DB Verbindung, liest die Nutzerbewertungen zu dem aufgerufenen Artikel aus
$db5 = new PDO($dsn, $dbuser, $dbpass);
$sql5 = "SELECT * FROM userrating WHERE ean='".$ean."'";
$query5 = $db5->prepare($sql5);
$query5->execute();

$allratings = 0;
$amount = 0;

$username = $_SESSION["userid"];

//Alle Bewertungen werden zusammengezählt und die Gesamtanzahl der Bewertungen wird ermittelt
while ($zeile5 = $query5->fetchObject()) {
    $amount += count($zeile5->rating);
    $allratings += $zeile5->rating;
}
//Durchschnitt der Nutzerbewertungen wird ermittelt
if($amount != 0) {
    $userrating = $allratings / $amount;
}

//DB Verbindung zu Produkt Tabelle
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";
echo "<div class='col-sm-12' >";
//Produktinformationen werden ausgegeben
if ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->name</h1>";
    echo "</div></div>";
    echo "<div class='row trenn' style='margin-bottom: 0'>";
    echo "<div class='col-sm-6'>";
    echo "<span class='kategorie'>GENRE</span><br>";
    echo "$zeile->genre<br><br>";
    echo "<span class='kategorie'>BESCHREIBUNG</span><br>";
    echo "<p>$zeile->beschreibung </p><br/><br/> \n";
    $preis = $zeile->preis;
    $rating = $zeile->rating;
    $genre = $zeile->genre;
    $ean = $zeile->ean;
    echo "</div><div class='col-sm-6'>";
    echo "<div>";
    //Überprüft ob ein Bild hochgeladen wurde, wenn ja wird das Bild ausgegeben, wenn nein dann wird kein Bild ausgegeben
    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img class='img_product' src='./files/uploads/$zeile->bild'/>";
    } else {
        echo "";
    }
    //Bewertungen werden ausgegeben
    echo "<span class='kategorie'>BEWERTUNGEN</span>";
    echo "<div class='row'>";
    echo "<div class='col-sm-6'>";
    echo "<div class='rating text-center'>$rating<div class='kategorie'>Betacritic</div></div>";
    echo "</div>";
    echo "<div class='col-sm-6'>";
    echo "<div class='rating text-center'>$userrating ($amount Bewertungen)<div class='kategorie'>Nutzerbewertungen</div></div>";
    echo "</div>";
    echo "</div><br>";
    //Preis wird ausgegeben
    echo "<div class='row'>";
    echo "<div class='col-sm-6'>";
    echo "<div class='kategorie'>PREIS</div>";
    echo $preis . "€";
    echo "</div>";
    echo "<div class='col-sm-6'>";
    echo "<span class='kategorie'>EAN</span><br>";
    echo $ean;
    echo "</div></div>";
    //Warenkorb Feld wird ausgegeben
    echo "<form action='./functions/cart/cartupdate_do.php' method='get'>
          <input type='hidden' value='$zeile->ean' name='ean'>";
    echo "<br><div class='row'>";
    echo "<div class='col-sm-2'>";
    echo "<div><input class='form-control' type='number' min='0' value='1' name='anzahl'></div></div>";
    echo "<div class='col-sm-10'>";
    if (isset ($username)) {
    echo "<div><input class=\"form-control button_orange\" type='submit' value='In den Warenkorb legen'></form></div></div></div></div>";
}else {
    echo "<div class='form-control text-center button_gray'>In den Warenkorb legen (<a href='?page=users&action=login'>Bitte zuerst einloggen!</a>)</div><div></form></div></div></div></div>";
    }
    echo "</div></div>";
} else {
    //Fehlermeldung wenn Produkt nicht gefunden wird
    print "Produkt mit EAN $ean nicht gefunden!";
}
$db = null;

//DB Verbindung für Nutzerbewertungen/Kommentare
$db2 = new PDO($dsn, $dbuser, $dbpass);
$sql2 = "SELECT * FROM userrating WHERE ean=$ean";
$query2 = $db2->prepare($sql2);
$query2->execute();

echo "<div class='row product_boxes'>";
echo "<div class='col-sm-12'>";
echo "<h2 style='padding-top: 0.5em;'>NUTZERBEWERTUNGEN</h2>";
echo "</div></div>";
echo "<div class='row product_boxes trenn'>";

//Nutzerbewertungen werden ausgegeben
while ($zeile2 = $query2->fetchObject()) {
    echo "<div class='col-sm-2'>";
    echo "<h5>$zeile2->username</h5>";
    echo "<div class='rating text-center'>$zeile2->rating<br><div class='kategorie'>BEWERTUNG</div></div><br>";
    echo "</div>";
    echo "<div class='col-sm-4'><br>";
    echo "<div><div class='kategorie'>KOMMENTAR</div>$zeile2->comment</div>";
    echo "</div>";
    $amount += count($zeile2->rating);
};

//Überprüft ob keine Nutzerbewertungen eingetragen sind
if($amount == 0) {
    //gibt Fehlermeldung aus
    echo "<div class='col-sm-12'>";
    echo "Keine Nutzerbewertungen gefunden.<br><br>";
    echo "</div>";
}
echo "</div>";

$db2 = null;

echo "<div class='row'>";
echo "<div class='col-sm-12 trenn'>";
echo "<h2>PRODUKT BEWERTEN:</h2>";

//DB Verbindung zu Nutzerbewertungen Tabelle
$db3 = new PDO($dsn, $dbuser, $dbpass);
$sql3 = "SELECT username FROM userrating WHERE ean=$ean";
$query3 = $db3->prepare($sql3);
$query3->execute();
$check_ifuserexist = false;

//Überprüft ob Nutzer bereits bewertet hat
while ($zeile3 = $query3->fetchObject()) {
    if ($zeile3->username == $username) {
        $check_ifuserexist = true;
    };
}

//Wenn der Nutzer noch nicht bewertet hat wird ein leeres Bewertungsformular ausgegeben
if ($check_ifuserexist == false) {
    if (isset($username)) {
        echo('
            <form action = "./functions/products/rate_do.php" method = "post" >
            <input type = "hidden" name = "username" value = "');
        echo($username);
        echo('" >
            <span class=\'kategorie\'>KOMMENTAR</span><br>
            <textarea class="form-control" name = "comment" rows=\'4\' cols=\'20\' placeholder = "Dein Kommentar"></textarea>
            <span class=\'kategorie\'>BEWERTUNG (0-100)</span><br>
            <input class="form-control" type = "number" name = "rate" min="0" max="100" placeholder = "Deine Bewertung (0-100)" >
            <input type = "hidden" name = "ean" value = "');
        echo($ean);
        echo('"><br>
            <input class="form-control button_orange" type = "submit" value = "Bewerten" >
            </form >
            ');
    } else echo("Um Produkt zu bewerten bitte <a class='login_link' href='?page=users&action=login'>logge dich zuerst ein</a>!");
} else include_once('./functions/products/rateupdate_form.php'); //Wenn Nutzer schon bewertet hat wird ein Bearbeitungsformular ausgegeben

echo "</div>";

echo "<div class='col-sm-12 product_boxes'><h2 style='padding-top: 0.5em;'>SPIELE DIE DIR AUCH GEFALLEN KÖNNTEN:</h2></div>";
echo "<div class='row product_boxes trenn'>";

//DB Verbindung, Gibt alle Produkte aus die die gleiche Genre haben wie der angezeigte Artikel außer der angezeigte Artikel
$db4 = new PDO($dsn, $dbuser, $dbpass);
$sql4 = "SELECT * FROM sortiment WHERE genre='".$genre."' AND ean != '".$ean."'";
$query4 = $db4->prepare($sql4);
$query4->execute();

//Gibt die gefundenen Artikel aus
while ($zeile4 = $query4->fetchObject()) {
    echo "<div class='col-sm-4'>";
    echo "<a href='?ean=$zeile4->ean'>";
    echo "<img class='img_product' src='./files/uploads/$zeile4->bild'/>";
    echo "</a>";
    echo "<div class='text-center'>$zeile4->name</div><br>";
    echo "</div>";
}
echo "</div></div>";




?>