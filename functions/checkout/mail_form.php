<?php
session_start();
include_once("../db.php");
$db = new PDO($dsn, $dbuser, $dbpass);
$username = $_SESSION['userid'];

if(isset($_SESSION['userid'])) {
    $sql = "SELECT * FROM users WHERE username='".$username."'";
    $query = $db->prepare($sql);
    $query->execute();

    if ($zeile = $query->fetchObject()) {
        $email = $zeile -> email;
    };
}
?>

<form action="mail_do.php" method="post">

    <?php
    if(isset($_SESSION['userid'])) {
        echo "<input type='text' name='user_email' value='$email'/><br>";
    }
    else {
        echo "<input type='text' name='new_email' placeholder='Deine E-Mail'/><br>";

    }
    ?>
    <input type="submit" value="Submit"/>

</form>
