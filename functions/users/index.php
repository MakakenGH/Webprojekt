<?php
//Routing für User
if (isset($_GET["action"]))
{
    switch ($_GET["action"]) {
        case "register":
            include "./functions/users/register_form.php";
            break;
        case "login":
            include "./functions/users/login_form.php";
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