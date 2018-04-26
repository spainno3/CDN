<?php require_once ('libs/config.php'); ?>

<?php

if (isset($_SESSION['userId'])) {
    session_destroy();
}
header('Location: login.php');
?>