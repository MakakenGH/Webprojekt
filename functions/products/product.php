<?php
session_start();
$db5 = new PDO($dsn, $dbuser, $dbpass);
$sql5 = "SELECT * FROM userrating WHERE ean='".$ean."'";
$query5 = $db5->prepare($sql5);
$query5->execute();
$allratings = 0;
$amount = 0;
$username = $_SESSION["userid"];


while ($zeile5 = $query5->fetchObject()) {
    $amount += count($zeile5->rating);
    $allratings += $zeile5->rating;
}
if($amount != 0) {
    $userrating = $allratings / $amount;
}

$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();



echo "<div class='row'>";
echo "<div class='col-sm-12' >";
if ($zeile = $query->fetchObject()) {

    echo "<h1>$zeile->name</h1>";
    echo "</div></div>";
    echo "<div class='row trenn'>";
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

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img class='img_product' src='./files/uploads/$zeile->bild'/>";
        echo "<span class='kategorie'>BEWERTUNGEN</span>";
        echo "<div class='row'>";
        echo "<div class='col-sm-6'>";
        echo "<div class='rating text-center'>$rating<div class='kategorie'>Betacritic</div></div>";
        echo "</div>";
        echo "<div class='col-sm-6'>";
        echo "<div class='rating_user text-center'>$userrating ($amount Bewertungen)<div class='kategorie'>Nutzerbewertungen</div></div>";
        echo "</div>";
        echo "</div><br>";
        echo "<div class='kategorie'>PREIS</div>";
        echo $preis."€";
        echo "<form action='./functions/cart/cartupdate_do.php' method='get'>
              <input type='hidden' value='$zeile->ean' name='ean'>";
        echo "<br><div class='row'>";
        echo "<div class='col-sm-2'>";
        echo "<div><input class='form-control' type='number' min='0' value='1' name='anzahl'></div></div>";
        echo "<div class='col-sm-10'>";
        echo "<div><input class=\"form-control button_orange\" type='submit' value='In den Warenkorb legen'></form></div></div></div></div>";


    }
    else {
        echo "";
    }
    echo "</div></div>";
} else {
    print "Produkt mit EAN $ean nicht gefunden!";
}
$db = null;

$db2 = new PDO($dsn, $dbuser, $dbpass);
$sql2 = "SELECT * FROM userrating WHERE ean=$ean";
$query2 = $db2->prepare($sql2);
$query2->execute();

echo "<div class='row' style='padding: 10px;'>";
echo "<div class='col-sm-12'>";
echo "<h2>NUTZERBEWERTUNGEN</h2>";
echo "</div></div>";
echo "<div class='row' style='padding: 10px; margin-bottom: 1em; border-bottom: 1px solid #333';>";

while ($zeile2 = $query2->fetchObject()) {
    echo "<div class='col-sm-2'>";
    echo "<h5>$zeile2->username</h5>";
    echo "<div style='padding: 5px; border: 1px solid white;' class='text-center'>$zeile2->rating<br><div class='kategorie'>BEWERTUNG</div></div><br>";
    echo "</div>";
    echo "<div class='col-sm-10'><br>";
    echo "<div><div class='kategorie'>KOMMENTAR</div>$zeile2->comment</div>";
    echo "</div>";
    $amount += count($zeile2->rating);
    $allratings += $zeile2->rating;
};
if($amount != 0) {
    $userrating = $allratings / $amount;
}else {
    echo "<div class='col-sm-12'>";
    echo "Keine Nutzerbewertungen gefunden.<br><br>";
    echo "</div>";
}
echo "</div>";

$db2 = null;

echo "<div class='col-sm-12 trenn'>";
echo "<h2>PRODUKT BEWERTEN:<br></h2>";
$db3 = new PDO($dsn, $dbuser, $dbpass);
//* $data = $db3->query("SELECT username FROM userrating WHERE ean=$ean")->fetchAll(PDO::FETCH_ASSOC);
$sql3 = "SELECT username FROM userrating WHERE ean=$ean";
$query3 = $db3->prepare($sql3);
$query3->execute();
$check_ifuserexist = false;
while ($zeile3 = $query3->fetchObject()) {
    if ($zeile3->username == $username) {
        $check_ifuserexist = true;
    };
}

if ($check_ifuserexist == false) {
    if (isset($username)) {
        echo('
            <form action = "./functions/products/rate_do.php" method = "post" >
                <input type = "hidden" name = "username" value = "');
        echo($username);
        echo('" ><br >
                <textarea class="form-control" name = "comment" rows=\'10\' cols=\'50\' placeholder = "Dein Kommentar"></textarea>
                <input class="form-control" type = "number" name = "rate" min="0" max="100" placeholder = "Deine Bewertung (0-100)" >
                <input type = "hidden" name = "ean" value = "');
        echo($ean);
        echo('"><br>
                <input class="form-control button_orange" type = "submit" value = "Abschicken" >
            </form >
            ');
    } else echo('Um Produkt zu bewerten bitte logge dich zuerst ein!');
} else include_once('./functions/products/rateupdate_form.php');

echo "</div>";

echo "<div class='col-sm-12'><h2>SPIELE DIE DIR AUCH GEFALLEN KÖNNTEN:</h2></div>";
echo "<div class='row'>";
$db4 = new PDO($dsn, $dbuser, $dbpass);
$sql4 = "SELECT * FROM sortiment WHERE genre='".$genre."' AND ean != '".$ean."'";
$query4 = $db4->prepare($sql4);
$query4->execute();

while ($zeile4 = $query4->fetchObject()) {
    echo "<div class='col-sm-4'>";
    echo "<a href='?ean=$zeile4->ean'>";
    echo "<img class='img_product' src='./files/uploads/$zeile4->bild'/>";
    echo "</a>";
    echo "<div class='text-center'>$zeile4->name</div><br>";
    echo "</div>";
}
echo "</div>";




?>