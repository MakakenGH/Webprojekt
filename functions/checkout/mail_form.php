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
    <div><b>Bitte wähle eine Zahlungsmethode aus:</b></div>
    <fieldset>
        <input type="radio" id="mc" name="Zahlmethode" value="Mastercard" checked="checked">
        <label for="mc"><img src="./files/uploads/mastercard-alternate.png" alt="MasterCard" width="85"></label>
        <input type="radio" id="pp" name="Zahlmethode" value="Paypal">
        <label for="pp"> <img src="./files/uploads/paypal.png" alt="PayPal" width="85"></label>
        <input type="radio" id="vi" name="Zahlmethode" value="Visa">
        <label for="vi"><img src="./files/uploads/visa.png" alt="Visa" width="85"></label>
        <input type="radio" id="gp" name="Zahlmethode" value="Giropay">
        <label for="gp"><img src="./files/uploads/giropay.png" alt="Giropay" width="85"></label>
    </fieldset>
    <?php
    //Verwendet bei eingeloggten Nutzer die gespeicherte E-Mail und bei einem neuen Nutzer ein leeres Feld
    if(isset($_SESSION['userid'])) {
        echo "<br><b>Wie ist deine E-Mail Adresse?</b><br>(Deine Keys werden dir per E-Mail zugeschickt)<br>";
        echo "<input class='form-control' type='text' name='user_email' value='$email'/>";
    }
    else {
        echo "<br><b>Wie ist deine E-Mail Adresse?</b><br>(Deine Keys werden dir per E-Mail zugeschickt)<br>";
        echo "<input class='form-control' type='text' name='new_email' placeholder='Deine E-Mail'/>";

    }
    ?>

    <input class='form-control button_orange' type="submit" value="Zahlen und Bestellen"/>
</form>
