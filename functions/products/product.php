<?php
session_start();
include_once ("../db.php");
include_once ("../../widgets/navigation.php");
$ean = $_GET["ean"];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->name</h1> \n";
    echo "$zeile->genre<br><br>";

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img src='../../files/uploads/$zeile->bild'/><br><br> \n";
    }
    else {
        echo "";
    }

    echo "$zeile->beschreibung <br/><br/> \n";


    echo "Preis: $zeile->preis € / Betacritic: $zeile->rating <br><br>";
    echo "$zeile->ean <br><br>";


} else {
    print "Produkt mit EAN $ean nicht gefunden!";
}
$db = null;

    echo "NUTZERBEWERTUNGEN<br>";


$db2 = new PDO($dsn, $dbuser, $dbpass);
$sql2 = "SELECT * FROM userrating WHERE ean=$ean";
$query2 = $db2->prepare($sql2);
$query2->execute();
$allratings = 0;
$amount = 0;

while ($zeile2 = $query2->fetchObject()) {
    echo "<b>$zeile2->username</b><br>";
    echo "$zeile2->comment<br>";
    echo "Bewertung: $zeile2->rating<br><br>";
    $amount += count($zeile2->rating);
    $allratings += $zeile2->rating;

};

if($amount != 0) {
    $userrating = $allratings / $amount;

    echo "GESAMT: <br>";
    echo round($userrating)."<br><br>";

}else echo "Keine Nutzerbewertungen gefunden.<br><br>";

$username = $_SESSION["userid"];

echo "Produkt bewerten:<br>";
if(isset($username)) {
    echo ('
    <form action = "rate_do.php" method = "post" >
        <input type = "hidden" name = "username" value = "'); echo ($username);echo('" ><br >
        Dein Kommentar: <input type = "text" name = "comment" placeholder = "Kommentar" ><br >
        Deine Bewertung*: <input type = "number" name = "rate" min="0" max="100" placeholder = "0-100" ><br >
        <input type = "hidden" name = "ean" value = "');echo ($ean);echo ('"><br >
        <input type = "submit" value = "Abschicken" >
    </form >
');
}
else echo ('Um Produkt zu bewerten bitte logge dich zuerst ein!');
include_once ("../../widgets/footer.php");
?>