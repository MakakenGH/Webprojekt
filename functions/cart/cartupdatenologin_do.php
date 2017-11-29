<?php
session_start();

$ean = $_GET["ean"];

$_SESSION["cart"] = $ean;

header("Location: ../../index.php?page=store&action=store");