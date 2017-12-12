<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DAMPF!</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="files/style/style.css">
</head>
<body id="body">

<?php
session_start();
include ("./functions/db.php");
$_SESSION['prevurl'] = $_SERVER['HTTP_REFERER'];
?>

<div class="container-fluid"><!-- Header -->
<div class="navbar">
    <div id="logo"><a href="index.php"><img style="height: 50px; width: auto;" src="files/uploads/logo_small.png" alt="HOME"></a></div>
    <ul class="ul_nav">
    <li class="li_nav"><a href="?page=store&action=store">Store</a></li>
    <li class="li_nav"><a href="?news">News</a></li>
    <li class="li_nav"><a href="?page=users&action=login">Login</a></li>
    <li class="li_nav"><a href="?page=users&action=register">Registrieren</a></li>
    <li class="li_nav"><a href="?page=users&action=logout">Logout</a></li>
    <li class="li_nav"><div id="searchbar"><?php include_once ("./functions/search.php");?></div></li>
    <li class="li_nav"><a href="./functions/cart/cart_show.php" target='_blank'>Warenkorb</a></li>
</ul>
</div>

</div>
<div class="container-fluid" id="include_area"> <!-- Include Bereich (Content) -->
<?php
$ean = $_GET["ean"];
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
        case "safedata":
            include "./files/Footer/Datenschutz.html";
            break;
        case "warenkorb":
            include "warenkorb.php";
            break;
    }
?>
</div>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
<div class="container-fluid"> <!-- Footer -->
    <div class="row" id="footer_defined">
        <div class="col-sm-4"><b>Rechtliches</b>
    <ul>
        <li>Impressum</li>
        <li><a href="?page=safedata">Datenschutz</a></li>
        <li>AGB</li>
        <li>FAQ</li>
        <li>Wiederrufsrecht</li>
        <li>Versand- und Zahlungsarten</li>
    </ul>
    </div>
    <div class="col-sm-4">
        <b>Informationen</b>
        <ul>
            <li>Über uns</li>
            <li>Kontakt</li>
            <li>Karriere</li>
        </ul>
    </div >
    <div class="col-sm-4">
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