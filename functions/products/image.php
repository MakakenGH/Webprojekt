<?php

require ("../db.php");

// Bild ausgeben
$db = new PDO ($dsn, $dbuser, $dbpass);
$id = 67;
$query = $db->prepare("SELECT produktbild, mimetype FROM sortiment WHERE id=$id");
$query->execute(array("id"=>$id));
$zeile=$query->fetch();
$data=$zeile['image'];
header("Content-type: image/gif"); // image/jpeg, image/png, ...

echo '<img src="$data"/>';?>