<?php
session_start();

$ean = $_POST("ean");

$_SESSION["cart"] = $ean;

header("Location: ../../index.php");