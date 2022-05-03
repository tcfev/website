<?php
    if (session_status() == PHP_SESSION_NONE)
        session_start();
    if (isset($_GET['lang']))
        $_SESSION['lang'] = $_GET['lang'];
    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    $l = $_SESSION['lang'];
?>