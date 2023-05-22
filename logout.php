<?php
    // Destroy Session and set header back to login
    session_start();
    session_destroy();
    header('Location: login.php');
    exit;
?>