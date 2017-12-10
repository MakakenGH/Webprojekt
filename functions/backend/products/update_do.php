<?php
session_start();
$ean = $_POST["ean"];
$name = $_POST["name"];
$beschreibung = $_POST["beschreibung"];
$preis = $_POST["preis"];
$rating = $_POST["rating"];
$genre = $_POST["genre"];
$oldbild = $_POST["oldbild"];
if (strlen ($_FILES['bild']['name']) > 0) {
	$produktbild = $_FILES['bild']['name'];
} else {
	$produktbild = $oldbild;
}
$filename = pathinfo($_FILES['bild']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['bild']['name'], PATHINFO_EXTENSION));

$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');

if (!empty($ean) && !empty($name) && !empty($beschreibung) && !empty($preis) && !empty($rating) && !empty($genre)) {
    try {
        include_once("../../db.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE sortiment SET name= :name, beschreibung= :beschreibung, genre= :genre, preis= :preis, rating= :rating, bild= :bild WHERE ean= :ean");
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

if(in_array($extension, $allowed_extensions)) {
    move_uploaded_file($_FILES['bild']['tmp_name'], '../../../files/uploads/'.$_FILES['bild']['name']);
	if ($oldbild !== $produktbild) {
	unlink ('../../../files/uploads/'.$oldbild);
	header("Location: ../../../admin.php");
	}
}
else {
	$_SESSION["error"] = "true";
	header("Location: ../../../admin.php");
    die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
}
