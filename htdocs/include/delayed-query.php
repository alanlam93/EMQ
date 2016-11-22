<?php
if (isset($_POST['id'], $_POST['duration'])) {
    require_once("mysql-config.php");
    $mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
    if ($mysqli === null) {
        return;
    }
    $mysqli->multi_query("SELECT SLEEP({$_POST['duration']}); UPDATE `order` SET STATUS = 'Delivered' WHERE id = {$_POST['id']};");
    $mysqli->close();
}
?>