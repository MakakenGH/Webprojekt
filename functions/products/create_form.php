<?php
include_once ("./functions/users/admincheck.php?ean") //Da nur Admins Produkte hinzufügen sollen
?>


    <form action="./functions/products/create_do.php" method="post" enctype="multipart/form-data" class="form_1">

        <input type="text" name="name" placeholder="Artikelname" /><br>
        <input type="text" name="preis" placeholder="Preis" /><br>
        <textarea name="beschreibung" placeholder="Artikelbeschreibung" rows="10"></textarea><br>
        <input type="text" name="genre" placeholder="Genre" /><br>
        <input type="number" name="rating" placeholder="Bewertung" /><br>
        <input type="file" name="bild" /><br>
        <input type="submit" value="Submit"/>

    </form>
