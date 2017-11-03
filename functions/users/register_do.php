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
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];


    if(strlen($password) == 0) {
        echo 'Passwort eingeben<br>';
        $error = true;
    }
    if($password != $password2) {
        echo 'Die Passwörter stimmen nicht überein!<br>';
        $error = true;
    }

    if(!$error) {
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
        $result = $statement->execute(array('username' => $username));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Dieser Login ist schon vergeben<br>';
            $error = true;
        }
    }

    if(!$error) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = $db->prepare("INSERT INTO users (username, password, email, name) VALUES (:username, :password, :email, :name)");
        $result = $statement->execute(array('username' => $username, 'password' => $password_hash, 'email' => $email, 'name' => $name));
        $db = null;
        if($result) {
            echo 'Registrierung erfolgreich! <a href="../../index.php">zurück</a>';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist ein Fehler aufgetreten<br>';
        }
    }
}

?>

</body>
</html>