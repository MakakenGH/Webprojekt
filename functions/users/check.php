<?php
    if(!isset($_SESSION['userid'])) {
        echo "<span class='check'>";
        die('Bitte zuerst einloggen');
        echo "</span>";
    }
?>