<?php

$ean = $_POST["ean"];
$username = $_POST["username"];
$comment = $_POST["comment"];
$rating = $_POST["rating"];

if (!empty($ean) && !empty($username) && !empty($rating)) {
    try {
        include_once("../db.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE userrating SET comment= :comment, rating= :rating WHERE ean= :ean AND username= :username");
        $query->execute(array("comment" => $comment, "rating" => $rating, "ean" => $ean, "username" => $username));
        $db = null;
        header('Location: ../../index.php?ean='.$ean);
    } catch (PDOException $e) {
        echo "Error!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!".$username.$ean.$rating;
}