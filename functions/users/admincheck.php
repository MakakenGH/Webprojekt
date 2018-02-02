<?php
include_once ("./functions/db.php");

$sessionid = $_SESSION['userid'];

//DB Verbindung zu Admin Tabele
$db = new PDO($dsn, $dbuser, $dbpass);
$query = $db->prepare("SELECT username FROM admins WHERE username = '".$sessionid."'");
$query->execute();
$zeile = $query->fetchObject();

//Überprüft ob der eingeloggte User Admin ist
if((!isset($zeile->username)) or ($_SESSION['userid'] != $zeile->username)) {
    die('Keine Berechtigung die Aktion auszuführen! Bitte wende dich an einen Admin.');}

?>