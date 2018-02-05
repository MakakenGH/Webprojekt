<?php

//Eingaben aus Formularfeld werden ausgelesen
$rating = htmlspecialchars($_POST["rate"]);
$ean=$_POST["ean"];
$username=$_POST["username"];
$comment= htmlspecialchars($_POST["comment"]);

include_once ("../db.php");

//DB Verbindung
$db = new PDO($dsn, $dbuser, $dbpass);

//Lädt Bewertung in die Datenbank.
if(!empty($rating)) {
    $statement = $db->prepare("INSERT INTO userrating (ean, username, comment, rating) VALUES (:ean, :username, :comment, :rating)");
    $result = $statement->execute(array('ean' => $ean, 'username' => $username, 'comment' => $comment, 'rating' => $rating));
    $db = null;
    if($result) {
        echo 'Danke für deine Bewertung!';
        //Vorherige Produktseite wird aufgerufen.
        header('Location: ../../index.php?ean='.$ean);
    } else {
        echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
    }
}
