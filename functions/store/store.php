<table>
<?php
include_once("./functions/db.php");

    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM sortiment ORDER BY rating DESC";
    $query = $db->prepare($sql);
    $query->execute();

    while ($zeile = $query->fetchObject()) {
        echo "<tr>";
        echo "<td>";
        echo "<img src='./files/uploads/$zeile->bild'/><br>";
        echo "</td>";
        echo "<td>$zeile->name</td>";
        echo "<td>$zeile->beschreibung</td>";
        echo "<td>$zeile->rating</td>";
        echo "<td>$zeile->preis</td>";
        echo "</tr>";
    }
?>
</table>
