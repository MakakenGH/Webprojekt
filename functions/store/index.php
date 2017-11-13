<?php
if (isset($_GET["action"]))
{

    switch ($_GET["action"]) {
        case "store":
            include "./functions/store/store2.php";
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