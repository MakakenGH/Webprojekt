<?php

if (isset($_GET["action"]))
{

    switch ($_GET["action"]) {
        case "overview":
            include "./functions/backend/products/overview.php";
            break;
        case "edit":
            include "update_form.php";
            break;
        case "delete":
            include "delete1.php";
            break;
        case "create":
            include "./functions/backend/products/create_form.php";
            break;
    }

}
else
{

if (isset($_GET["editmode"]))
{

    switch ($_GET["editmode"]) {
        case "true":
            include "./functions/backend/products/overview_edit.php";
            break;
        case "false":
            include "./functions/backend/products/overview.php";
            break;
    }

}
else
{
    echo "Seite nicht gefunden";
}};