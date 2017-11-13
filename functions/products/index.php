<?php
if (isset($_GET["action"]))
{

    switch ($_GET["action"]) {
        case "view":
            include "show.php";
            break;
        case "edit":
            include "update_form.php";
            break;
        case "delete":
            include "delete1.php";
            break;
        case "create":
            include "./functions/products/create_form.php";
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