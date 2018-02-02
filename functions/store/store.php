<?php

session_start();
include_once("./functions/db.php");
$genre = "";
echo " <div class = 'row'>";
echo "<div class = 'col-sm-2 text-center '><a class='form-control button_store' href='?page=store&action=store&genre=all'>All Games </a></div>";
echo "<div class = 'col-sm-2 text-center '><a class='form-control button_store' href='?page=store&action=store&genre=action'>Action </a></div>";
echo "<div class = 'col-sm-2 text-center '><a class='form-control button_store' href='?page=store&action=store&genre=rts'>Real Time Strategy </a></div>";
echo "<div class = 'col-sm-2 text-center '><a class='form-control button_store' href='?page=store&action=store&genre=sport'>Sport </a></div>";
echo "<div class = 'col-sm-2 text-center '><a class='form-control button_store' href='?page=store&action=store&genre=puzzle'>Puzzle </a></div>";
echo "<div class = 'col-sm-2 text-center '><a class='form-control button_store' href='?page=store&action=store&genre=fps'>FPS </a></div>";
echo "</div>";


switch ($_GET["genre"]) {
    case "all":
        $genre = "all";
        break;
    case "action":
        $genre = "action";
        break;
    case "rts":
        $genre = "rts";
        break;
    case "sport":
        $genre = "sport";
        break;
    case "puzzle":
        $genre = "puzzle";
        break;
    case "fps":
        $genre = "fps";
        break;
    default:
        $genre = "all";
        break;
}

$db = new PDO($dsn, $dbuser, $dbpass);
if ($genre == "all") {
    $sql = "SELECT * FROM sortiment ORDER BY rating DESC";
}else {
    $sql = "SELECT * FROM sortiment WHERE genre='".$genre."' ORDER BY rating DESC";

}
$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";
while ($zeile = $query->fetchObject()) {

    echo "<div class='col-sm-4' id='store_defined'>";
    echo "<a href='?ean=$zeile->ean'>";
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "</a>";
    echo "<div class='store_text'>";
    echo "<span style='font-size:45px'><b>$zeile->name</b></span><br>";
    echo "<span class='fa fa-thumbs-o-up' style='font-size: 36px'>$zeile->rating</span><br><br>";
    echo "<span class='fa fa-eur' style='font-size:36px'>$zeile->preis</span><br><br>";
    if (isset($_SESSION['userid'])) {
        echo "<form action='./functions/cart/cartupdate_do.php' method='get'><input type='hidden' value='$zeile->ean' name='ean'><input type='number' min='0' value='1' style='max-width: 50px' name='anzahl'>&nbsp;<input type='submit' class='button_orange' value='In den Warenkorb legen'></form>";
    }
    else {
        echo "<a href='?page=users&action=login'><button class='button_grey'>(Bitte einloggen)</button></a>";
    }
    echo "</div></div><br><br><br>";}
echo "</div>";
