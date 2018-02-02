<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DAMPF!</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
    </style>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="files/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php echo "<script type='text/javascript'>"; include_once ("./files/style/JS.js"); echo "</script>"; ?>
</head>
<body id="body">

<?php
session_start();
include ("./functions/db.php");
$_SESSION['prevurl'] = $_SERVER['HTTP_REFERER'];
$_SESSION['cururl'] = $_SERVER['REQUEST_URI'];
?>

<div class="container-fluid"><!-- Header -->
    <div class="navbarcss">
        <div><a href="index.php"><img style="float: left; height: 50px; width: auto;" src="files/uploads/logo_small.png" alt="HOME"></a>
            <ul class="ul_nav">
                <li class="li_nav"><a href="?page=store&action=store"><i class="fa fa-gamepad" aria-hidden="true"></i>&nbsp;&nbsp;Store</a></li>
                <li class="li_nav"><a href="?page=news&action=news"><i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;&nbsp;News</a></li>
                <li class="li_nav" style="float: right;"><a href="?page=warenkorb"><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp;&nbsp;Warenkorb</a></li>
                <li class="drop_nav" style="float: right;">
                    <a href="javascript:void(0)" class="drop_nav_button"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;&nbsp;Nutzer</a>
                    <div class="drop_nav_cont">
                        <a href="?page=users&action=login">Login</a>
                        <a href="?page=users&action=logout">Logout</a>
                        <a href="?page=users&action=register">Registrieren</a>
                        <a href="admin.php">Admin</a>
                    </div>
                </li>
                <li class="li_nav" style="float: right;"><div id="searchbar"><?php include_once("./functions/search/search.php");?></div></li>
            </ul>
</div>
</div>
</div>

<div class="container-fluid" id="include_area"> <!-- Include Bereich (Content) -->
    <?php
    $search=$_GET["search"];

    $ean = $_GET["ean"];
    if (isset($ean)) {
        include ("./functions/products/product.php");
    }elseif (isset($search)){
        include ("./functions/search/search_do.php");
    } else
    {
    switch ($_GET["page"]) {
        case "":
            include "./widgets/frontpage.php";
            break;
        case "store":
            include "./functions/store/index.php";
            break;
        case "news":
            include "./functions/news/news.php";
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
            include "./functions/cart/cart_show.php";
            break;
        case "checkout":
            include "./functions/checkout/checkout_form.php";
            break;
        case "impressum":
            include "./files/Footer/impressum.html";
            break;
        case "FAQ":
            include "./files/Footer/FAQ.html";
            break;
        case "AGB":
            include "./files/Footer/agb.html";
            break;
        case "widerruf":
            include "./files/Footer/widerruf.html";
            break;
        case "zahlungsarten":
            include "./files/Footer/zahlungsarten.html";
            break;
        case "searchdo":
            include "./functions/search/search_do.php";
            break;
    }}
    ?>

<div class="footer_defined"> <!-- Footer -->
    <div class="row">
        <div class="col-sm-4 text-center">
            <b style="font-size: large;">Rechtliches</b>
            <ul class="footer_ul">
                <li><a class="footer_links" href="?page=impressum">Impressum</a></li>
                <li><a href="?page=safedata" class="footer_links">Datenschutz</a></li>
                <li><a href="?page=AGB" class="footer_links">AGB</a></li>
                <li><a href="?page=FAQ" class="footer_links">FAQ</a></li>
                <li><a href="?page=widerruf" class="footer_links">Widerrufsrecht</a></li>
                <li><a href="?page=zahlungsarten" class="footer_links">Versand- und Zahlungsarten</a></li>
            </ul>
        </div>
        <div class="col-sm-4 text-center">
            <b style="font-size: large;">Informationen</b>
            <ul class="footer_ul">
                <li><a target="_blank" href="http://www.omm.hdm-stuttgart.de" class="footer_links"> Über Uns </a></li>
                <li><a target="_blank" href="http://www.omm.hdm-stuttgart.de/kontakt" class="footer_links">Kontakt</a></li>
                <li><a target="_blank" href="http://www.omm.hdm-stuttgart.de/bewerbung" class="footer_links">Karriere</a></li>
            </ul>
        </div >
        <div class="col-sm-4 text-center">
            <b style="font-size: large;"">Social Media</b>
            <ul class="footer_ul">
                <li> <a target="_blank" href="https://www.facebook.com/omm.hdm" class="footer_links">Facebook</a></li>
                <li> <a target="_blank" href="https://www.instagram.com/omm.hdm" class="footer_links">Instagram</a></li>
                <li> <a target="_blank" href="https://twitter.com/DAMPFofficial" class="footer_links">Twitter</a></li>
            </ul>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>



