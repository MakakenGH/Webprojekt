<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DAMPF!</title>
</head>
<body>
<?php
session_start();
?>
<div><!-- Header -->
<ul>
    <li><a href="?store">Store</a></li>
    <li><a href="?news">News</a></li>
    <li><a href="index.php?page=products&action=create">News</a></li>
    <li><a href="index.php?page=users&action=login">Login</a></li>
    <li><a href="index.php?page=users&action=register">Registrieren</a></li>
    <li><a href="./functions/users/logout_do.php">Logout</a></li>
    <li><a href="?warenkorb">Warenkorb</a></li>
</ul>
</div>
<div> <!-- Include Bereich (Content) -->
<?php
include_once("functions/db.php"); /*Datenbankverbindung herstellen*/
if(isset($_GET["page"])) {
    switch ($_GET["page"]) {
            case "store":
                include "store.php";
                break;
            case "news":
                include "news.php";
                break;
            case "products":
                include "./functions/products/index.php";
                break;
            case "users":
                include "./functions/users/index.php";
                break;
            case "warenkorb":
                include "warenkorb.php";
                break;
            default:
                echo "Seite nicht gefunden";
                die();
                break;
            }
    }
?>
</div>

<div> <!-- Footer -->
    <div style="float: left; margin: 10px;">
    <b>Rechtliches</b>
    <ul>
        <li>Impressum</li>
        <li>Datenschutz</li>
        <li>AGB</li>
        <li>FAQ</li>
        <li>Wiederrufsrecht</li>
        <li>Versand- und Zahlungsarten</li>
    </ul>
    </div>
    <div style="float: left; margin: 10px;">
        <b>Informationen</b>
        <ul>
            <li>Über uns</li>
            <li>Kontakt</li>
            <li>Karriere</li>
        </ul>
    </div >
    <div style="float: left; margin: 10px;">
        <b>Social Media</b>
        <ul>
            <li>Facebook</li>
            <li>Instagram</li>
            <li>Twitter</li>
        </ul>
    </div>
</div>


</body>
</html>