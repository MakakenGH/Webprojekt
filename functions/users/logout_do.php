<?php
//Session wird geschlossen
    session_start();
    session_destroy();
    $prev_url2 = $_SERVER['HTTP_REFERER'];
//Weiterleiten des Nutzers zur vorherigen Seite/URL
    header ("Location: $prev_url2");
?>
