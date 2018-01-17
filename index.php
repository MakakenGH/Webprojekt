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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <?php echo "<script type='text/javascript'>"; include_once ("./files/style/JS.js"); echo "</script>"; ?>
</head>
<body id="body">

<?php
session_start();
include ("./functions/db.php");
$_SESSION['prevurl'] = $_SERVER['HTTP_REFERER'];
?>

<div class="container-fluid"><!-- Header -->
    <nav class="navbar navbar-expand-sm navbar-dark sticky-top">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="navbar-brand" href="index.php"><img style="height: 50px; width: auto;" src="files/uploads/logo_small.png" alt="HOME"></a></li>
            <li class="nav-item"><a class="nav-link" href="?page=store&action=store">Store</a></li>
            <li class="nav-item"><a class="nav-link" href="?page=news&action=news">News</a></li>
            <li class="nav-item"><div id="searchbar"><?php include_once("./functions/search/search.php");?></div></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Nutzerverwaltung
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="?page=users&action=login">Login</a>
                    <a class="dropdown-item" href="?page=users&action=register">Registrieren</a>
                    <a class="dropdown-item" href="?page=users&action=logout">Logout</a>
                    <a class="dropdown-item" href="admin.php">Admin</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="?page=warenkorb">Warenkorb</a></li>
        </ul>
    </nav>
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


    }
    ?>
</div>

<div class="container-fluid"> <!-- Footer -->
    <div class="row" id="footer_defined">
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
                <li><a href="http://www.omm.hdm-stuttgart.de"style="text-decoration: none"> Über Uns </a></li>
                <li><a href="http://www.omm.hdm-stuttgart.de/kontakt"style="text-decoration: none">Kontakt</a></li>
                <li><a href="http://www.omm.hdm-stuttgart.de/bewerbung"style="text-decoration: none">Karriere</a></li>
            </ul>
        </div >
        <div class="col-sm-4">
            <b>Social Media</b>
            <ul>
                <li> <a href="https://www.facebook.com/omm.hdm"style="text-decoration: none">Facebook</a></li>
                <li> <a href="https://www.instagram.com/omm.hdm"style="text-decoration: none">Instagram</a></li>
                <li> <a href="https://twitter.com/DAMPFofficial"style="text-decoration: none">Twitter</a></li>
            </ul>
        </div>
    </div>


</body>
</html>