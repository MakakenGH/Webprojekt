<?php
session_start();
include_once("../db.php");

$ean = $_POST("ean");

$_SESSION("cart) = $ean;

