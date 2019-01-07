<?php
if (isset($_SESSION["errors"])) {
    echo '<div class="notification">';
    foreach ($_SESSION["errors"] as $value) {
        ?>
        <div class="alert alert-danger" role="alert"><?php echo $value; ?></div>
        <?php
    }
    echo '</div>';
    unset($_SESSION["errors"]);
}
if (isset($_SESSION["success"])) {
    echo '<div class="notification">';
    foreach ($_SESSION["success"] as $value) {
        ?>
        <div class="alert alert-success" role="alert"><?php echo $value; ?></div>
        <?php
    }
    echo '</div>';
    unset($_SESSION["success"]);
}
?>