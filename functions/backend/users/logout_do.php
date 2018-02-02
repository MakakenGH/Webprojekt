<?php
//Schließt die Session
session_start();
session_destroy();
$prev_url2 = $_SERVER['HTTP_REFERER'];
//Öffnet nach Login die vorherige URL
header ("Location: $prev_url2");
?>
