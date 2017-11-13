<?php
include_once("../db.php");
$db = new PDO($dsn, $dbuser, $dbpass);

$username = $_POST['name'];

//Läd Adminusername in die Datenbank hoch
if (!empty($username)) {
    try {
        $statement = $db->prepare("INSERT INTO admins (username) VALUES (:username)");
        $statement->execute(array('username' => $username));
        $db = null;
        header('Location: ../../index.php');
    } catch (PDOException $e) {
        echo "Error!";
        die();
    }
}
else {
    echo ("Bitte einen Username eintragen");
}

?>