
<form class="form-inline action="?page=search&action=index.php" method="get" >
    <?php
    // Wenn Nutzer etwas gesucht hat, wird Formular mit Suchwort angezeigt. Wenn nicht dann wird ein leeres Formular angezeigt.
    if (isset($search)) {
        echo "<input type=\"text\" class=\"form-control mr-sm-2\" style=\"max-width: 160px; max-height: 30px;\" size=\"40\" maxlength=\"30\" name=\"search\" list=\"games\" value=$search>";
    }else {
        echo "<input type=\"text\" class=\"form-control mr-sm-2\" style=\"max-width: 160px; max-height: 30px;\" size=\"40\" maxlength=\"30\" name=\"search\" list=\"games\" placeholder=\"Suche (Name, Genre)\">";
    }
    ?>
    <input class="button_orange" style="max-height: 30px; text-align-all: center;" type="submit" value="Suchen">

</form>
