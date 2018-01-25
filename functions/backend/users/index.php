<?php
if (isset($_GET["action"]))
{
    //Backend User Routing
    switch ($_GET["action"]) {
        case "logout":
            include "logout_do.php";
            break;
        case "admincreate":
            include "./functions/backend/users/admincreate_form.php";
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