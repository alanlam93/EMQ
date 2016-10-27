<?php

require_once("mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while logging in.";
    return;
}

$email = $mysqli->real_escape_string($_POST['email']);
$result = $mysqli->query("SELECT * from account WHERE `email` = '$email'");
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] == hash('sha512', $_POST['password'] . $row['salt'])) {
        session_start();
        $_SESSION["userid"] = $row['id'];
        $_SESSION["name"] = $row['first_name'];
    } else {
        echo "No account with this email and password was found.";
    }
} else {
    echo "No account with this email and password was found.";
}
$result->close();
$mysqli->close();
?>