<?php
session_start();

//Eingaben aus Formularen werden geladen
$ean = $_POST["ean"];
$name = $_POST["name"];
$beschreibung = $_POST["beschreibung"];
$preis = $_POST["preis"];
$rating = $_POST["rating"];
$genre = $_POST["genre"];
$oldbild = $_POST["oldbild"];
//Überprüft ob ein neues Bild hochgeladen/eingebenen wurde
if (strlen ($_FILES['bild']['name']) > 0) {
	$produktbild = $_FILES['bild']['name'];
} else {
	$produktbild = $oldbild;
}
$filename = pathinfo($_FILES['bild']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['bild']['name'], PATHINFO_EXTENSION));

//erlaubte Dateiendungen
$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');

//Überprüft ob Variablen/Formulareingaben komplett sind
if (!empty($ean) && !empty($name) && !empty($beschreibung) && !empty($preis) && !empty($rating) && !empty($genre)) {
    try {
        //DB Verbindung
        include_once("../../db.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare("UPDATE sortiment SET name= :name, beschreibung= :beschreibung, genre= :genre, preis= :preis, rating= :rating, bild= :bild WHERE ean= :ean");
        $query->execute(array("name" => $name, "beschreibung" => $beschreibung, "genre" => $genre, "preis" => $preis, "rating" => $rating, "bild" => $produktbild, "ean" => $ean));
        $db = null;
		header("Location: ../../../admin.php");
    } catch (PDOException $e) {
		$_SESSION["error"] = "true";
    	die();
    }
} else {
	header("Location: ../../../admin.php");
	$_SESSION["error"] = "true";
	die();
}

//wenn dateiendungen valide wird das Bild auf den Server geladen
if(in_array($extension, $allowed_extensions)) {
    move_uploaded_file($_FILES['bild']['tmp_name'], '../../../files/uploads/'.$_FILES['bild']['name']);
    //Wenn ein neues Bild hochgeladen wird, wird das alte Bild vom Server gelöscht
	if ($oldbild !== $produktbild) {
	unlink ('../../../files/uploads/'.$oldbild);
	header("Location: ../../../admin.php");
	}
}
else {
    //Wenn dateiendung nicht valide wird der vorgang abgebrochen
	$_SESSION["error"] = "true";
	header("Location: ../../../admin.php");
    die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
}
