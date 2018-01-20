<?php
session_start();
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

<form action="./functions/checkout/checkout_do.php" method="post">

    <?php
    if(isset($_SESSION['userid'])) {
        echo "<input class='form-control' type='text' name='user_email' value='$email'/>";
    }
    else {
        echo "<input class='form-control' type='text' name='new_email' placeholder='Deine E-Mail'/>";

    }
    ?>
    <input class='form-control button_orange' type="submit" value="Zahlen und Bestellen"/>

</form>
