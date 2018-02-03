<?php
session_start();
include_once("../db.php");
$db = new PDO($dsn, $dbuser, $dbpass);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
</head>
<body>

<?php
$showFormular = true;

if(isset($_GET['register'])) {
    $error = false;
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);

    //Überprüft ob beide eingebenen Passwörter übereinstimmen und setzt 'failded' auf wert 1 bzw 2
    if(strlen($password) == 0) {
        $error = true;
        $_SESSION['regfailed'] = 1;
        header("Location: ../../index.php?page=users&action=register");
    }
    if($password != $password2) {
        $error = true;
        $_SESSION['regfailed'] = 2;
        header("Location: ../../index.php?page=users&action=register");
    }

    //Überprüft ob Username schon vergeben ist und setzt 'failded' auf wert 3 falls nicht
    if(!$error) {
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();

        if($user !== false) {
            $error = true;
            $_SESSION['regfailed'] = 3;
            header("Location: ../../index.php?page=users&action=register");
        }
    }

    //neuer Nutzer wird in Datenbank gespeichert wenn erfolgreich wird der Key 'failed' auf 5 gesetzt, falls nicht auf 4
    if(!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT); //passwort wird verschlüsselt

        $statement = $db->prepare("INSERT INTO users (username, password, email, name) VALUES (:username, :password, :email, :name)");
        $result = $statement->execute(array('username' => $username, 'password' => $password_hash, 'email' => $email, 'name' => $name));
        $db = null;
        if($result) {
            $showFormular = false;
            $_SESSION['regfailed'] = 5;
            header("Location: ../../index.php?page=users&action=register");
        } else {
            echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
            $_SESSION['regfailed'] = 4;
            header("Location: ../../index.php?page=users&action=register");
        }
    }
}

?>

</body>
</html>