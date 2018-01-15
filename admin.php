<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DAMPF!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="files/style/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed');
    </style>
</head>
<body>

<?php
session_start();
include ("./functions/db.php");
require_once ("./functions/backend/admincheck.php");
$_SESSION['prevurl'] = $_SERVER['REQUEST_URI'];
?>

<div class="container-fluid"><!-- Header --->
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


<div class="container-fluid" id="include_area"> <!-- Include Bereich (Content) -->
<?php
$ean = $_GET["ean"];
if (isset($ean)) {
    include ("./functions/products/product.php");
};
$search=$_POST["search"];
if(isset($search)) {
	include ("./functions/backend/products/adminsearch_do.php");
}
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>