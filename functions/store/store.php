<span style="font-size: xx-large "> Wähle deine Lieblingskategorie!</span>
<?php
session_start();
include_once("./functions/db.php");
$genre = "";

echo "<div id='store_defined_genre'>";
echo "<div class = 'row'>";
echo "<div class = 'col-sm-2 text-center '><a href='?page=store&action=store&genre=all' style='text-decoration: none;'><button class='form-control button_orange'>All Games</button></a></div>";
echo "<div class = 'col-sm-2 text-center '><a href='?page=store&action=store&genre=action' style='text-decoration: none;'><button class='form-control button_orange'>Action</button></a></div>";
echo "<div class = 'col-sm-2 text-center '><a href='?page=store&action=store&genre=rts'style='text-decoration: none;'><button class='form-control button_orange'>Real Time Strategy</button></a></div>";
echo "<div class = 'col-sm-2 text-center '><a href='?page=store&action=store&genre=sport'style='text-decoration: none;'><button class='form-control button_orange'> Sport </button></a></div>";
echo "<div class = 'col-sm-2 text-center '><a href='?page=store&action=store&genre=puzzle'style='text-decoration: none'><button class='form-control button_orange'> Puzzle </button></a></div>";
echo "<div class = 'col-sm-2 text-center '><a href='?page=store&action=store&genre=fps'style='text-decoration: none'><button class='form-control button_orange'> FPS</button></a></div>";
echo "</div></div>";
echo "<br><br>";
echo "<span style=\"font-size: xx-large\"> DAMPF! durchsuchen:</span>";
echo "<br><br>";

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
    echo "<a class='store_link' href='?ean=$zeile->ean'>";
    echo "<span style='font-size:xx-large'><b>$zeile->name</b></span><br><br>";
    echo "</a>";
    echo "<div class= 'row trenn'>";
    echo "<div class='col-sm-4 '>";
    echo "<span class='kategorie'>GENRE<br> </span><span class='search_ausgabe'>$zeile->genre</span> <br></div>";
    echo "<div class='col-sm-4'>";
    echo "<span class='kategorie'> BEWERTUNG <br></span> <span class='search_ausgabe'> $zeile->rating</span> <br><br></div>";
    echo "<div class='col-sm-4'>";
    echo "<span class='kategorie'> PREIS<br> </span><span class='search_ausgabe'> $zeile->preis €</span><br><br></div></div>";
    if (isset($_SESSION['userid'])) {
        echo "<form action='./functions/cart/cartupdate_do.php' method='get'><input type='hidden' value='$zeile->ean' name='ean'><input type='number' min='0' value='1' style='max-width: 50px' name='anzahl'>&nbsp;<input type='submit' class='button_orange' value='In den Warenkorb legen'></form>";
    }
    else {
        echo "<div class='form-control text-center button_gray'><i class=\"fa fa-shopping-basket\" aria-hidden=\"true\"> </i> In den Warenkorb legen (<a href='?page=users&action=login'>Bitte zuerst einloggen!)</a></div>";
    }
    echo "</div></div><br><br><br>";}
echo "</div>";
