<span style="font-size: xx-large "> Wähle deine Lieblingskategorie!</span>
<?php
session_start();
include_once("./functions/db.php");
$genre = "";
//Genre Buttons werden angezeigt.
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
//Routing für die Genres
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
// Wenn Genre festgelgt wurde, dann wird nach dem jeweiligen Genre gesucht. Wenn nich, dann wird die gesammte Sortiment-DB ausgegeben.
if ($genre == "all") {
    $sql = "SELECT * FROM sortiment ORDER BY rating DESC";
}else {
    $sql = "SELECT * FROM sortiment WHERE genre='".$genre."' ORDER BY rating DESC";

}
$query = $db->prepare($sql);
$query->execute();

echo "<div class='row'>";

//Die Ergebnisse der Suche, werden dann hier ausgegeben.
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
    //Wenn der User eingeloggt ist kann man das Produkt in den Warenkorb legen.
    if (isset($_SESSION['userid'])) {
        echo "<form action='./functions/cart/cartupdate_do.php' method='get'>";
        echo "<input type='hidden' value='$zeile->ean' name='ean'>";
        echo "<div class='row'>";
        echo "<div class='col-sm-3'>";
        echo "<input class='form-control' type='number' min='1' max='100' value='1' name='anzahl'>";
        echo "</div>";
        echo "<div class='col-sm-9'>";
        echo "<input type='submit' class='form-control button_orange' value='In den Warenkorb legen'></div></div></form>";
     //Wenn der User nicht eingeloggt ist, erscheint die bitte sich zuerst einzuloggen um das Produkt in den Warenkorb legen zu können.
    }
    else {
        echo "<div class='form-control text-center button_gray'><i class=\"fa fa-shopping-basket\" aria-hidden=\"true\"> </i> In den Warenkorb legen (<a href='?page=users&action=login'>Bitte zuerst einloggen!)</a></div>";
    }
    echo "</div></div><br><br><br>";}
echo "</div>";
