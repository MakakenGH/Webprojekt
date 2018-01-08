<?php
session_start();
if (isset($_GET["action"]))
{

    switch ($_GET["action"]) {
        case "view":
            include "./functions/backend/products/overview.php";
            break;
    }

}
