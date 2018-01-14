<?php
$_SESSION['prevprevurl'] =  $_SERVER['HTTP_REFERER'];
?>
<div class="row">
    <div class="col-md-3 col-centered log_window">

    <h4>LOGIN</h4>
    <form action="./functions/users/login_do.php?login=1" method="post">
    <input type="text" size="40" maxlength="250" name="username" placeholder="Login"><br>

    <input type="password" size="40"  maxlength="250" name="password" placeholder="Dein Passwort"><br>
<br>
    <input type="submit" class="button_orange" value="Abschicken">
</form>
        <?php
        session_start();

        if ($_SESSION['failed'] = 2) {
            echo "<br><span style='color: red;'><b>Login oder Passwort ist ungültig!</b></span>";
        } ?>
</div>
</div>
