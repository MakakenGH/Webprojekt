<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DAMPF!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="files/style/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
    </style>
</head>
<body class="b_bg">

<?php
session_start();
include ("./functions/db.php");
require_once ("./functions/backend/admincheck.php");
$_SESSION['prevurl'] = $_SERVER['REQUEST_URI'];
?>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills flex-column">

                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-laptop"></i>   Frontend Ansicht</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=products&action=overview">Produktübersicht</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=products&action=create">Produkt hinzufügen</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=users&action=admincreate">Admin hinzufügen</a></li>
                <li class="nav-item"><?php include_once ("./functions/backend/products/adminsearch_form.php");?><li>
                <li class="nav-item"><a class="nav-link" href="?page=users&action=logout">Logout</a></li>

            </ul>
        </nav>

        <?php
        $ean = $_GET["ean"];
        if (isset($ean)) {
            include ("./functions/products/product.php");
        };
        $search=$_POST["search"];

        if(isset($search)) {
            include ("./functions/backend/products/adminsearch_do.php");
        }
        ?>

        <?php
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
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>