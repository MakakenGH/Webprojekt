<?php
$rating = $_POST["rate"];
$ean=$_POST["ean"];
$username=$_POST["username"];
$comment=$_POST["comment"];

include_once ("../db.php");

$db = new PDO($dsn, $dbuser, $dbpass);

if(!empty($rating)) {

    $statement = $db->prepare("INSERT INTO userrating (ean, username, comment, rating) VALUES (:ean, :username, :comment, :rating)");
    $result = $statement->execute(array('ean' => $ean, 'username' => $username, 'comment' => $comment, 'rating' => $rating));
    $db = null;
    if($result) {
        echo 'Danke für deine Bewertung!';
        header('Location: https://mars.iuk.hdm-stuttgart.de/~nf025/functions/products/product.php?ean='.$ean);
        $showFormular = false;
    } else {
        echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
    }
}
