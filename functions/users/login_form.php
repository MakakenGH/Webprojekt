<?php
session_start();
//Vorherige URL wird abgerufen
$_SESSION['prevprevurl'] =  $_SERVER['HTTP_REFERER'];
//Wenn für den Key 'failed' noch kein anderer Wert gesetzt ist, wird der Wert auf 0 gesetzt
if (!isset ($_SESSION['failed'])) {
    $_SESSION['failed'] = 0;
}

?>

    <div class="row" style="margin-top: 5%;">
    <div class="col-md-3 col-centered log_window">

        <h4 class="text-center">LOGIN</h4>
        <form action="./functions/users/login_do.php?login=1" method="post">
            <span class='kategorie text-left'>USERNAME</span><br>
            <input type="text" class="form-control" maxlength="20" name="username" placeholder="Username">
            <span class='kategorie text-left'>PASSWORT</span><br>
            <input type="password" class="form-control" maxlength="20" name="password" placeholder="Dein Passwort"><br>
            <input type="submit" class="form-control button_orange" value="Einloggen">
        </form><br>
        <span>Noch keinen Account? <a href="?page=users&action=register" style="color: darkorange;">Hier</a> gehts zur Registrierung</span><br>

        <?php
        //im login_do wird - je nach "Fehlerfall"- dem Key 'failed' ein anderer Wert zugewiesen. Für jeden Fehlerfall wird dem User eine entsprechende
        //Nachricht eingeblendet, was das Problem ist (Usability - Selbsterklärend, Systemüberschaubarkeit).

        if ($_SESSION['failed'] == 2) {
            echo "<br><span class='col-centered' style='color: red;'><b>Login oder Passwort ist ungültig!</b></span>";
        } else { echo "";}

        ?>
    </div>
</div>

