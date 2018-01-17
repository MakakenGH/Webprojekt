<?php
$ean = $_POST["ean"];
echo "<span>Wirklich Löschen?</span><br><br>";
echo "<span><a href='./functions/backend/products/delete2.php?id=$ean''>ja</span></a>          ";
echo "<span><a href='index.php'>nein</span></a>";
?>