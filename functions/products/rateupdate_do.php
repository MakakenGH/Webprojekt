<?php

//Daten aus dem Formular werden zugewiesen
$ean = $_POST["ean"];
$username = $_POST["username"];
$comment = htmlspecialchars($_POST["comment"]);
$rating = htmlspecialchars($_POST["rating"]);

//Überpüft ob alle erfolderlichen Daten vorhanden sind
if (!empty($ean) && !empty($username) && !empty($rating)) {
    try {
        include_once("../db.php");
        //DB Verbindung
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare("UPDATE userrating SET comment= :comment, rating= :rating WHERE ean= :ean AND username= :username");
        $query->execute(array("comment" => $comment, "rating" => $rating, "ean" => $ean, "username" => $username));
        $db = null;
        //Produktseite wird wieder geöffnet
        header('Location: ../../index.php?ean='.$ean);
    } catch (PDOException $e) {
        echo "Error!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";
}