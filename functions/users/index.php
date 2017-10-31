<?php
if (isset($_GET["action"]))
{

    switch ($_GET["action"]) {
        case "register":
            include "register_form.php";
            break;
        case "login":
            include "login_form.php";
            break;
        case "logout":
            include "logout_do.php";
            break;
        default:
            echo "Seite nicht gefunden";
            die();
            break;


    }

}
else
{
    echo "Seite nicht gefunden";
}