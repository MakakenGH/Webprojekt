<?php
include_once ("./functions/db.php");

$sessionid = $_SESSION['userid'];
$login_error = $_SESSION['loginerror'];

$db = new PDO($dsn, $dbuser, $dbpass);

//DB Verbindung, Läd Spalte der Admintabelle wo username = eingeloggter Nutzer
$query = $db->prepare("SELECT username FROM admins WHERE username = '".$sessionid."'");
$query->execute();
$zeile = $query->fetchObject();

//Überprüft ob der eingeloggte User Admin ist
if((!isset($zeile->username)) or ($_SESSION['userid'] != $zeile->username)) {

	include_once ("./functions/backend/users/login_form.php");
	?>
<div class="col-md-3 col-centered text-center error">
    <?php
    //gibt bei Fehler, Login Fehlermeldung aus
	if (isset($login_error)){
	echo "$login_error<br>";
	die("");
	}
	else {
    die("Logge dich als Admin ein!");
	}
}
?>
</div>