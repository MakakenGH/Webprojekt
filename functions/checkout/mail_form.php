<?php
session_start();
$db = new PDO($dsn, $dbuser, $dbpass);

$username = $_SESSION['userid'];

//Überprüft ob Nutzer eingeloggt ist
if(isset($_SESSION['userid'])) {
    $sql = "SELECT * FROM users WHERE username='".$username."'";
    $query = $db->prepare($sql);
    $query->execute();

    //liest E-Mail des eingeloggten Nutzers aus
    if ($zeile = $query->fetchObject()) {
        $email = $zeile -> email;
    };
}
?>

<!-- E-Mail Formular-->
<form action="./functions/checkout/checkout_do.php" method="post">

    <?php
    //Verwendet bei eingeloggten Nutzer die gespeicherte E-Mail und bei einem neuen Nutzer ein leeres Feld
    if(isset($_SESSION['userid'])) {
        echo "<input class='form-control' type='text' name='user_email' value='$email'/>";
    }
    else {
        echo "<input class='form-control' type='text' name='new_email' placeholder='Deine E-Mail'/>";

    }
    ?>

    <input class='form-control button_orange' type="submit" value="Zahlen und Bestellen"/>
</form>
