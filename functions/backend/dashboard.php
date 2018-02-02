<?php
session_start();
include_once("./functions/db.php");

$username = $_SESSION['userid'];

//DB Verbindng, läd angegebenen Namen aus der DB
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM users WHERE username='".$username."'";
$query = $db->prepare($sql);
$query->execute();

if($zeile = $query->fetchObject()) {
    $name = $zeile->name;
}

if (isset($_SESSION['createerror']))
{
    switch ($_SESSION['createerror']) {
        case 1:
            echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt- text-center\" style='color: red;'>";
            echo "Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt";
            echo "</main>";
            $_SESSION['createerror'] = 0;
            break;
        case 2:
            echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 text-center\" style='color: red;'>";
            echo "Bitte alle Felder ausfüllen!";
            echo "</main>";
            $_SESSION['createerror'] = 0;
            break;
        case 3:
            echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 text-center\" style='color: green;'>";
            echo "Produkt erfolgreich hinzugefügt!";
            echo "</main>";
            $_SESSION['createerror'] = 0;
            break;
    }
}else {
//Gibt Willkommensnachricht aus
    echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\" style='color: #333;'>";
    echo "<h2 class='text-center' style='padding-top: 25%'>Willkommen zurück <b>$name</b>!</h2>";
    echo "</main>";
}

