<?php
$_SESSION['prevprevurl'] =  $_SERVER['HTTP_REFERER'];

if (!isset ($_SESSION['failed'])) {
    $_SESSION['failed'] = 0;
}

?>

    <div class="row" style="margin-top: 5%;">
    <div class="col-md-3 col-centered log_window">

        <h4 class="text-center">LOGIN</h4>
        <form action="./functions/users/login_do.php?login=1" method="post">
            <span class='kategorie text-left'>USERNAME</span><br>
            <input type="text" size="40" class="form-control" maxlength="250" name="username" placeholder="Username">
            <span class='kategorie text-left'>PASSWORT</span><br>
            <input type="password" size="40"  class="form-control" maxlength="250" name="password" placeholder="Dein Passwort"><br>
            <input type="submit" class="form-control button_orange" value="Einloggen">
        </form><br>
        <span>Noch keinen Account? <a href="?page=users&action=register" style="color: darkorange;">Hier</a> gehts zur Registrierung</span><br>

        <?php
        session_start();
        if ($_SESSION['failed'] == 2) {
            echo "<br><span class='col-centered' style='color: red;'><b>Login oder Passwort ist ungültig!</b></span>";
        } else { echo "";}

        ?>
    </div>
</div>
