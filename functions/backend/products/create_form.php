<?php
$_SESSION['prevprevurl'] =  $_SERVER['HTTP_REFERER'];
?>

    <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-5">
        <h3 class="text-center">PRODUKT HINZUFÜGEN</h3>
    <form action="./functions/backend/products/create_do.php" method="post" enctype="multipart/form-data">

        <input class="form-control" type="text" name="name" placeholder="Artikelname" />
        <input class="form-control" type="number" min="0" name="preis" placeholder="Preis" />
        <textarea class="form-control" name="beschreibung" placeholder="Artikelbeschreibung" rows="10"></textarea>
        <input class="form-control" type="text" name="genre" placeholder="Genre" />
        <input class="form-control" type="number" name="rating" placeholder="Bewertung" />
        <input class="form-control" type="file" name="bild" />
        <input class="form-control button_orange" type="submit" value="Submit"/>

    </form>
    </div>
