<div class="row">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="d-block w-100" src="files/uploads/gsf.png" alt="Global Strike Future" style="width:100%;">
            </div>

            <div class="item">
                <img class="d-block w-100" src="files/uploads/fafi17.png" alt="FAFI 17" style="width:100%;">
            </div>

            <div class="item">
                <img class="d-block w-100" src="files/uploads/titris3.png" alt="TITRIS 3" style="width:100%;">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="row">
    <div class="col" style="padding: 20px;">
        <?php
        $_SESSION['prevprevurl'] =  $_SERVER['HTTP_REFERER'];

        if (!isset ($_SESSION['failed'])) {
            $_SESSION['failed'] = 0;
        }

        ?>
        <div class="text-center log_window">

                <h4>LOGIN</h4>
                <form action="./functions/users/login_do.php?login=1" method="post">
                    <input type="text" size="40" class="form-control" maxlength="250" name="username" placeholder="Login"><br>
                    <input type="password" size="40"  class="form-control" maxlength="250" name="password" placeholder="Dein Passwort"><br>
                    <br>
                    <input type="submit" class="form-control button_orange" value="Abschicken">
                </form>
                <?php
                session_start();
                if ($_SESSION['failed'] == 2) {
                    echo "<br><span class='col-centered' style='color: red;'><b>Login oder Passwort ist ungültig!</b></span>";
                } else { echo "";}
                ?>
            </div>
        </div>

        <div class="col" style="padding: 20px;">
            <?php

            if (!isset ($_SESSION['failed'])) {
                $_SESSION['failed'] = 0;
            }
            ?>

                <div class="text-center log_window"">
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

        </div>

</div>
