<?php
include_once ("./widgets/slide.php");
?>

<?php
session_start();
include_once("./functions/db.php");

$genre = "";

echo "<br><a href='?page=store&action=store&genre=all'>ALL </a>";
echo "<a href='?page=store&action=store&genre=action'>ACTION </a>";
echo "<a href='?page=store&action=store&genre=rts'>RTS </a>";
echo "<a href='?page=store&action=store&genre=sport'>SPORT </a>";
echo "<a href='?page=store&action=store&genre=puzzle'>PUZZLE </a>";
echo "<a href='?page=store&action=store&genre=fps'>FPS </a><br><br>";

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
    echo "<img class='img_store' src='./files/uploads/$zeile->bild'/><br>";
    echo "<div class='store_text'>";
    echo "<span><b>$zeile->name</b></span><br>";
    echo "<span>$zeile->beschreibung</span><br>";
    echo "<span>$zeile->rating</span><br>";
    echo "<span>$zeile->preis</span><br>";
    echo "<span><a href='?ean=$zeile->ean'>Zur Produktseite</a></span><br>";
    echo "<form action='./functions/cart/cartupdate_do.php' method='get'><input type='hidden' value='$zeile->ean' name='ean'><input type='number' value='1' name='anzahl'>&nbsp;<input type='submit' class='button_orange' value='In den Warenkorb legen'></form>";
    echo "</div></div><br><br>";}
echo "</div>";
