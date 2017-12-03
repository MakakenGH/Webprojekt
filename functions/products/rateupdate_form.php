<?php
try {
    $db4 = new PDO($dsn, $dbuser, $dbpass);
    $sql4 = "SELECT * FROM userrating WHERE ean='".$ean."' AND username='".$username."'";
    $query4 = $db4->prepare($sql4);
    $query4->execute();
    if ($zeile4 = $query4->fetchObject()) {

        echo "<form action='./functions/products/rateupdate_do.php' method='post'>";
        echo "<input type='hidden' name='ean' value='$zeile4->ean'/>";
        echo "<input type='hidden' name='username' value='$zeile4->username'/>";
        echo "Kommentar: <br><textarea name='comment' rows='10' cols='50'>$zeile4->comment</textarea><br><br>";
        echo "Bewertung: <br><input type='number' name='rating' min=\"0\" max=\"100\" value='$zeile4->rating' /><br>";
        echo "<input type='submit' value='bearbeiten' />";
        echo "</form>";

    } else {
        echo "Error";
        echo "$username.$ean";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!";
    die();
}

?>