<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DAMPF!</title>
    <link rel="stylesheet" href="files/style/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
</head>
<body id="body">
<?php
session_start();
include_once ("./functions/db.php");

?>
<div class="container-fluid"><!-- Header -->
<ul class="ul_nav">
    <li style="background-color: darkorange;" class="li_nav"><a href="index.php">Home</a></li> <!-- Mit Logo zu ersetzen -->
    <li class="li_nav"><a href="?page=store&action=store">Store</a></li>
    <li class="li_nav"><a href="?news">News</a></li>
    <li class="li_nav"><a href="?page=products&action=create">Produkt hinzufügen</a></li>
    <li class="li_nav"><a href="?page=users&action=login">Login</a></li>
    <li class="li_nav"><a href="?page=users&action=register">Registrieren</a></li>
    <li class="li_nav"><a href="?page=users&action=logout">Logout</a></li>
    <li class="li_nav"><a href="?page=users&action=admincreate">Admin hinzufügen</a></li>
    <li class="li_nav"><div id="searchbar"><?php include_once ("./functions/search.php");?></div></li>
    <li class="li_nav"><a href="?warenkorb">Warenkorb</a></li>
</ul>
</div>
<div class="container-fluid"> <!-- Include Bereich (Content) -->
<?php
$ean = $_GET["ean"];
include_once("functions/db.php"); /*Datenbankverbindung herstellen*/
if (isset($ean)) {
    include ("./functions/products/product.php");
};
    switch ($_GET["page"]) {
        case "store":
            include "./functions/store/index.php";
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
    }
?>
</div>

<div class="container-fluid"> <!-- Footer -->
    <div class="row">
        <div class="col"><b>Rechtliches</b>
    <ul>
        <li>Impressum</li>
        <li>Datenschutz</li>
        <li>AGB</li>
        <li>FAQ</li>
        <li>Wiederrufsrecht</li>
        <li>Versand- und Zahlungsarten</li>
    </ul>
    </div>
    <div class="col">
        <b>Informationen</b>
        <ul>
            <li>Über uns</li>
            <li>Kontakt</li>
            <li>Karriere</li>
        </ul>
    </div >
    <div class="col">
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