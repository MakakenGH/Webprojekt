<?php
if(!isset($_SESSION['userid' == 1])) {
    echo "<span class='check'>";
    die('Keine Berechtigung die Aktion auszuführen! Bitte wende dich an einen Admin.');
    echo "</span>";
}
?>