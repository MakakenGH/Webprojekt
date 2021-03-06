<?php
//URL wird gespeichert
$_SESSION['prevprevurl'] =  $_SERVER['HTTP_REFERER'];
?>

<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-5">
<h3 class="text-center">PRODUKT HINZUFÜGEN</h3>

<!-- Formular zum Produkt hinzufügen -->
<form action="./functions/backend/products/create_do.php" method="post" enctype="multipart/form-data">
    <span class='kategorie'>ARTIKELNAME</span><br>
    <input class="form-control" type="text" maxlength="60" name="name" placeholder="Artikelname" />
    <span class='kategorie'>PREIS</span><br>
    <input class="form-control" type="number" min="0" name="preis" maxlength="10" placeholder="Preis" />
    <span class='kategorie'>BESCHREIBUNG</span><br>
    <textarea class="form-control" name="beschreibung" placeholder="Artikelbeschreibung" rows="10"></textarea>
    <span class='kategorie'>GENRE</span><br>
    <input class="form-control" type="text" name="genre" maxlength="50" placeholder="Genre" />
    <span class='kategorie'>BEWERTUNG</span><br>
    <input class="form-control" type="number" name="rating" maxlength="10" placeholder="Bewertung" />
    <span class='kategorie'>BILD (PNG, GIF, JPG)</span><br>
    <input class="form-control" type="file" name="bild" /><br>
    <input class="form-control button_orange" type="submit" value="Produkt hinzufügen"/>
</form>
</div>
