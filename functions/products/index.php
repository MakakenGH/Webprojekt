<?php

if (isset($_GET["action"]))
{
    //Routing für die Produkte
    switch ($_GET["action"]) {
        case "view":
            include "product.php";
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