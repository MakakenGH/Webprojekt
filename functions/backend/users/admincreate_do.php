<?php
include_once("../../db.php");

$username = $_POST['name'];

$db = new PDO($dsn, $dbuser, $dbpass);

//Lädt Adminusername in die Admin-Datenbank hoch
if (!empty($username)) {
    try {
        $statement = $db->prepare("INSERT INTO admins (username) VALUES (:username)");
        $statement->execute(array('username' => $username));
        $db = null;
        header('Location: ../../../admin.php');
    } catch (PDOException $e) {
        echo "Error!";
        die();
    }
}
else {
    echo ("Bitte einen Username eintragen");
}

?>