<?php
include_once ("./functions/users/admincheck.php") //Da nur Admins neue Admins hinzufügen dürfen
?>

<form action="./functions/users/admincreate_do.php" method="post">

    <input type="text" name="name" placeholder="Username" /><br>

    <input type="submit" value="Submit"/>

</form>

