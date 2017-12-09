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
require_once ("./functions/backend/admincheck.php");
$_SESSION['prevurl'] = $_SERVER['REQUEST_URI'];
?>

<div class="container-fluid"><!-- Header -->
    <ul>
    <li><a href="index.php">Frontend Ansicht</a></li>
    <li><a href="?page=dashboard">Dashboard</a></li>
    <li><a href="?page=products&action=overview">Produktübersicht</a></li>
    <li><a href="?page=products&action=create">Produkt hinzufügen</a></li>
    <li><a href="?page=users&action=admincreate">Admin hinzufügen</a></li>
        <li class="li_nav"><div id="searchbar"><?php include_once ("./functions/backend/products/adminsearch_form.php");?></div></li><br><br>
    <li><a href="?page=users&action=logout">Logout</a></li>
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
        case "products":
            include "./functions/backend/products/index.php";
            break;
        case "users":
            include "./functions/backend/users/index.php";
            break;
        case "dashboard":
            include "./functions/backend/dashboard.php";
            break;
		default:
            include "./functions/backend/dashboard.php";
            break;
    }




?>
</div>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
</body>
</html>