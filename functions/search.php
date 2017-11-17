
<form action="./functions/search_do.php"method="post" >
    <input type="text" size="40" maxlength="250" name="search" placeholder="suche"><br>
</form>



<?php

include_once "db.php";

$sql = "SELECT * FROM sortiment";

?>
<
