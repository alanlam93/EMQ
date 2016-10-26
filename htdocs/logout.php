<?php
    session_start();
    session_destroy();
    if (strpos($_SERVER['HTTP_REFERER'], 'account') !== false) {
        header('Location: index.php');
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>