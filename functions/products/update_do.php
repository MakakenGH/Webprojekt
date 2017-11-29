<?php

$id = $_POST["id"];
$name = $_POST["name"];
$betreff = $_POST["betreff"];
$text = $_POST["text"];

if (!empty($id) && !empty($name) && !empty($betreff)) {
    try {
        include_once("userdata.php");
        $db = new PDO($dsn, $dbuser, $dbpass);
        $query = $db->prepare(
            "UPDATE cms_posts SET name= :name, betreff= :betreff, text= :text WHERE id= :id");
        $query->execute(array("name" => $name, "betreff" => $betreff, "text" => $text, "id" => $id));
        $db = null;
        header('Location: ../../index.php');
    } catch (PDOException $e) {
        echo "Error!";
        die();
    }
} else {
    echo "Error: Bitte alle Felder ausfüllen!";
}