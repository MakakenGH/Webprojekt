<?php
session_start();
include_once("../../db.php");

//DB Verbindung
$db = new PDO($dsn, $dbuser, $dbpass);

//Überprüft ob Nutzer schon eingeloggt ist
if(isset($_GET['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    //Sucht nach dem Username in der Datenbank
    $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();

    //Überprüft ob das eingebene Passwort zum Username passt
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['username']; //Setzt die userid = username (Datenbank: User)
        header("Location: ../../../admin.php");
    } else {
		$_SESSION['loginerror']="Login oder Passwort falsch!";
		header("Location: ../../../admin.php");

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if(isset($errorMessage)) {
    echo $errorMessage;
}
?>

</body>
</html>