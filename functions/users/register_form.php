<?php

if (!isset ($_SESSION['failed'])) {
    $_SESSION['failed'] = 0;
}
?>
<div class="row" style="margin-top: 5%;">
<div class="col-md-3 col-centered text-center log_window"">
    <h4>REGISTRIERUNG</h4>
    <form action="./functions/users/register_do.php?register=1" method="post">

        <input type="text" class="form-control" size="40" maxlength="250" name="name" placeholder="Vor- und Nachname">

        <input type="text" class="form-control" size="40" maxlength="250" name="username" placeholder="Benutzername">

        <input type="email" class="form-control" size="40" maxlength="250" name="email" placeholder="Deine E-Mail Adresse">

        <input type="password" class="form-control" size="40"  maxlength="250" name="password" placeholder="Dein Passwort">

        <input type="password" class="form-control" size="40" maxlength="250" name="password2" placeholder="Passwort wiederholen"><br>

        <input type="submit" class="form-control button_orange" value="Abschicken">
    </form>
<br>
<?php
switch ($_SESSION["regfailed"]) {
    case 1:
        echo "<span style='color: red'><b>Bitte gib ein Passwort ein!</b></span>";
        break;
    case 2:
        echo "<span style='color: red'><b>Die Passwörter stimmen nicht überein!</b></span>";
        break;
    case 3:
        echo "<span style='color: red'><b>Dieser Benutzername ist leider schon vergeben!</b></span>";
        break;
    case 4:
        echo "<span style='color: red'><b>Ein unbekannter Fehler ist aufgetreten! Bitte kontaktiere uns.</b></span>";
        break;
    case 5:
        echo "<span style='color: red'><b>Registrierung erfolgreich!</b></span>";
        break;
}

?>
</div></div>