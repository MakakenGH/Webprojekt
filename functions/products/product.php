<?php
session_start();
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM sortiment WHERE ean=$ean";
$query = $db->prepare($sql);
$query->execute();
if ($zeile = $query->fetchObject()) {
    echo "<h1>$zeile->name</h1> \n";
    echo "$zeile->genre<br><br>";

    $bildlg = strlen($zeile->bild);
    if ($bildlg >= 1) {
        echo "<img src='./files/uploads/$zeile->bild'/><br><br> \n";
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
$username = $_SESSION["userid"];

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
$db2 = null;

echo "Produkt bewerten:<br>";

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
                Dein Kommentar: <br><textarea name = "comment" rows=\'10\' cols=\'50\' placeholder = "Kommentar"></textarea><br >
                Deine Bewertung*: <br><input type = "number" name = "rate" min="0" max="100" placeholder = "0-100" ><br >
                <input type = "hidden" name = "ean" value = "');
        echo($ean);
        echo('"><br >
                <input type = "submit" value = "Abschicken" >
            </form >
            ');
    } else echo('Um Produkt zu bewerten bitte logge dich zuerst ein!');
} else include_once('./functions/products/rateupdate_form.php');
?>