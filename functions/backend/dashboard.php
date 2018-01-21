<?php
session_start();
include_once("./functions/db.php");
$username = $_SESSION['userid'];
$db = new PDO($dsn, $dbuser, $dbpass);
$sql = "SELECT * FROM users WHERE username='".$username."'";
$query = $db->prepare($sql);
$query->execute();
if($zeile = $query->fetchObject()) {
    $name = $zeile->name;
}
echo "<main class=\"col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3\" style='color: #333;'>";
echo "<h2 class='text-center' style='padding-top: 30%'>Willkommen zurück <b>$name</b>!</h2>";
echo "</main>";

