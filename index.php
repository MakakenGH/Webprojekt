<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DAMPF!</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
    </style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="files/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php echo "<script type='text/javascript'>"; include_once ("./files/style/JS.js"); echo "</script>"; ?>
</head>
<body id="body">

<?php
session_start();
include ("./functions/db.php");
$_SESSION['prevurl'] = $_SERVER['HTTP_REFERER'];
?>

<div class="container-fluid"><!-- Header -->
    <div class="navbarcss">
        <div><a href="index.php"><img style="float: left; height: 50px; width: auto;" src="files/uploads/logo_small.png" alt="HOME"></a>
            <ul class="ul_nav">
                <li class="li_nav" style="border-right: 1px solid darkorange;"><a href="?page=store&action=store"><i class="fa fa-gamepad" aria-hidden="true"></i>&nbsp;&nbsp;Store</a></li>
                <li class="li_nav" style="border-right: 1px solid darkorange;"><a href="?page=news&action=news"><i class="fa fa-twitter" aria-hidden="true"></i>&nbsp;&nbsp;News</a></li>
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
    $ean = $_GET["ean"];
    if (isset($ean)) {
        include ("./functions/products/product.php");
    };
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
    }
    ?>
<?php
$search=$_POST["search"];

if(isset($search)) {
    include("./functions/search/search_do.php");
}
?>
</div>
</div>

<div class="container-fluid footer_defined"> <!-- Footer -->
    <div class="row">
        <div class="col-sm-4"><b>Rechtliches</b>
            <ul>
                <li><a href="?page=impressum"style="text-decoration: none">Impressum</a></li>
                <li><a href="?page=safedata" style="text-decoration: none">Datenschutz</a></li>
                <li><a href="?page=AGB"style="text-decoration: none">AGB</a></li>
                <li><a href="?page=FAQ"style="text-decoration: none">FAQ</a></li>
                <li><a href="?page=widerruf"style="text-decoration: none">Widerrufsrecht</a></li>
                <li><a href="?page=zahlungsarten"style="text-decoration: none">Versand- und Zahlungsarten</a></li>
            </ul>
        </div>
        <div class="col-sm-4">
            <b>Informationen</b>
            <ul>
                <li><a target="_blank" href="http://www.omm.hdm-stuttgart.de" style="text-decoration: none"> Über Uns </a></li>
                <li><a target="_blank" href="http://www.omm.hdm-stuttgart.de/kontakt" style="text-decoration: none">Kontakt</a></li>
                <li><a target="_blank" href="http://www.omm.hdm-stuttgart.de/bewerbung" style="text-decoration: none">Karriere</a></li>
            </ul>
        </div >
        <div class="col-sm-4">
            <b>Social Media</b>
            <ul>
                <li> <a target="_blank" href="https://www.facebook.com/omm.hdm" style="text-decoration: none">Facebook</a></li>
                <li> <a target="_blank" href="https://www.instagram.com/omm.hdm" style="text-decoration: none">Instagram</a></li>
                <li> <a target="_blank" href="https://twitter.com/DAMPFofficial" style="text-decoration: none">Twitter</a></li>
            </ul>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>