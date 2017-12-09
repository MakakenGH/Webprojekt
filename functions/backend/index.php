<?php

if (isset($_GET["action"]))
{

    switch ($_GET["action"]) {
        case "view":
            include "product.php";
            break;
        case "edit":
            include "update_form.php";
            break;
        case "delete":
            include "delete1.php";
            break;
        case "create":
            include "create_form.php";
            break;

    }

}
else
{
    echo "Seite nicht gefunden";
}