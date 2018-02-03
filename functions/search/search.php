
<form class="form-inline action="?page=search&action=index.php" method="get" >
    <?php
    if (isset($search)) {
        echo "<input type=\"text\" class=\"form-control mr-sm-2\" style=\"max-width: 160px; max-height: 30px;\" size=\"40\" maxlength=\"250\" name=\"search\" list=\"games\" value=$search>";
    }else {
        echo "<input type=\"text\" class=\"form-control mr-sm-2\" style=\"max-width: 160px; max-height: 30px;\" size=\"40\" maxlength=\"250\" name=\"search\" list=\"games\" placeholder=\"suche\">
";
    }
    ?>
    <input class="button_orange" style="max-height: 30px; text-align-all: center;" type="submit" value="Suchen">

</form>
