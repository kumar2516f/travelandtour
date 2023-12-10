<?php
session_start();

if (isset($_SESSION['user'])) {
    // Unset the 'member' session variable
    unset($_SESSION['user']);

    session_destroy();

    header("Location: login.php");
    exit;
}
?>