<?php
?>


    <form action="./functions/products/create_do.php" method="post" enctype="multipart/form-data" class="form_1">

        <input type="text" name="name" placeholder="Artikelname" /><br>
        <input type="text" name="preis" placeholder="Preis" /><br>
        <textarea name="beschreibung" placeholder="Artikelbeschreibung" rows="10"></textarea><br>
        <input type="file" name="bild" /><br>
        <input type="submit" value="Submit"/>

    </form>
