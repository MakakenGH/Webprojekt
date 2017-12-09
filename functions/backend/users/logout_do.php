<div class="check">
    <?php
    session_start();
    session_destroy();
    $prev_url2 = $_SERVER['HTTP_REFERER'];
    header ("Location: $prev_url2");
    ?>

</div>