<?php

if (!isset ($_SESSION['failed'])) {
    $_SESSION['failed'] = 0;
}
?>
<div class="row" style="margin-top: 5%;">
<div class="col-md-3 col-centered log_window"">
    <h4 class="text-center">REGISTRIERUNG</h4>
    <form action="./functions/users/register_do.php?register=1" method="post">
        <span class='kategorie text-left'>VOR- UND NACHNAME</span><br>
        <input type="text" class="form-control" size="40" maxlength="250" name="name" placeholder="Vor- und Nachname">
        <span class='kategorie text-left'>USERNAME</span><br>
        <input type="text" class="form-control" size="40" maxlength="250" name="username" placeholder="Dein Username">
        <span class='kategorie text-left'>E-MAIL ADRESSE</span><br>
        <input type="email" class="form-control" size="40" maxlength="250" name="email" placeholder="Deine E-Mail Adresse">
        <span class='kategorie text-left'>PASSWORT</span><br>
        <input type="password" class="form-control" size="40"  maxlength="250" name="password" placeholder="Dein Passwort">
        <span class='kategorie text-left'>PASSWORT WIEDERHOLEN</span><br>
        <input type="password" class="form-control" size="40" maxlength="250" name="password2" placeholder="Passwort wiederholen"><br>
        <input type="submit" class="form-control button_orange" value="Registrieren">
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