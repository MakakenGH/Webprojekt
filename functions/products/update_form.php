<!DOCTYPE html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
include_once ("./system/users/check.php")
?>
<?php
try {
    include_once("userdata.php");
    $id = (int)$_GET["id"];
    $db = new PDO($dsn, $dbuser, $dbpass);
    $sql = "SELECT * FROM cms_posts WHERE id=$id";
    $query = $db->prepare($sql);
    $query->execute();
    if ($zeile = $query->fetchObject()) {

        echo "<div class='div_2'>";
        echo "<h1 id='h1_div2'>Eintrag $zeile->id</h1>";
        echo "<form action='./system/post/update_do.php' method='post' class='form_1'>";
        echo "<input type='hidden' name='id' value='$zeile->id' />";
        echo "Betreff: <br><input type='text' name='betreff' value='$zeile->betreff' /><br>";
        echo "Autor: <br><input type='text' name='name' value='$zeile->name' /><br>";
        echo "Inhalt:<br>";
        echo "<textarea name='text' rows='10' cols='50'>$zeile->text</textarea><br><br>";
        $bildlg = strlen($zeile->bild);
        if ($bildlg >= 1) {
            echo "<img src='uploads/$zeile->bild'/><br>";
        }
        else {
            echo "";
        }
        echo "<input type='submit' value='bearbeiten' />";
        echo "</form>";
        echo "</div>";

    } else {
        echo "Error";
    }
    $db = null;
} catch (PDOException $e) {
    echo "Error!";
    die();
}

?>

</body>
</html>