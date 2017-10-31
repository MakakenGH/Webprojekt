<?php
session_start();
include_once("../db.php");
$db = new PDO($dsn, $dbuser, $dbpass);

if(isset($_GET['login'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $statement = $db->prepare("SELECT * FROM cms_users WHERE login = :login");
    $result = $statement->execute(array('login' => $login));
    $user = $statement->fetch();

    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        header('Location: ../../index.php');
    } else {
        $errorMessage = "Login oder Passwort war ungültig<br>";
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