<?php
session_start();
$prevprev_url  = $_SESSION["prevprevurl"];
include_once("../db.php");
$db = new PDO($dsn, $dbuser, $dbpass);

if(isset($_GET['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Sucht nach dem Username in der Datenbank
    $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();

    //Überprüft ob das eingebene Passwort zum Username passt
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['username']; //Setzt die userid = username (Datenbank: User)
        $_SESSION['failed'] = 1;
        header("Location: $prevprev_url");
    } else {
        $_SESSION['failed'] = 2;
        header("Location: ../../index.php?page=users&action=login");
    }
}
?>

