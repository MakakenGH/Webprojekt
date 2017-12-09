<?php
session_start();
include_once("../../db.php");
$db = new PDO($dsn, $dbuser, $dbpass);

//Eingaben aus create_form werden geladen
$artikelname = $_POST["name"];
$preis = $_POST["preis"];
$artikelbeschreibung = $_POST["beschreibung"];
$genre = $_POST["genre"];
$bewertung = $_POST["rating"];
$produktbild = $_FILES['bild']['name']; //Name der Bilddatei mit Endung
$filename = pathinfo($_FILES['bild']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['bild']['name'], PATHINFO_EXTENSION));

//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');

//Eingaben werden in die Datenbank geladen
if (!empty($artikelname) && !empty($preis) && !empty($artikelbeschreibung) && !empty($preis)) {
    try {
        $statement = $db->prepare("INSERT INTO sortiment (name, beschreibung, genre, preis, rating, bild) VALUES (:name, :beschreibung, :genre, :preis, :rating, :bild)");
        $statement->execute(array('name' => $artikelname, 'beschreibung' => $artikelbeschreibung, 'genre'=> $genre, 'preis' => $preis, 'rating' => $bewertung, 'bild' => $produktbild));
        $db = null;
    } catch (PDOException $e) {
        echo "Error!";
        die();
    }
}
else {
    echo "Bitte alle Felder ausfüllen!<br/>";
}

//Bild wird auf den Server geladen
if(in_array($extension, $allowed_extensions)) {
    move_uploaded_file($_FILES['bild']['tmp_name'], '../../../files/uploads/'.$_FILES['bild']['name']);
    header("Location: ../../../admin.php");
}
else {
    die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
}
?>