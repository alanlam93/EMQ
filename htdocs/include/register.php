<?php

require_once("mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while creating your account.";
    return;
}

if (isset($_GET['email'])) {
    $email = $mysqli->real_escape_string($_GET['email']);
    $email_check_query = $mysqli->query("SELECT `email` from account WHERE `email` = '$email'");
    if ($email_check_query->num_rows > 0) {
        http_response_code(400);
    }
    $email_check_query->close();
} else {
    $email = $mysqli->real_escape_string($_POST['email']);
    $email_check_query = $mysqli->query("SELECT `email` from account WHERE `email` = '$email'");
    if ($email_check_query->num_rows > 0) {
        echo "An account with this email already exists.";
        $email_check_query->close();
        $mysqli->close();
        return;
    }
    $email_check_query->close();

    $salt = substr(hash('sha1', uniqid(rand(), true)), 0, 32);
    $password_sha512 = hash('sha512', $_POST['password'] . $salt);

    $mysqli->autocommit(false);

    $statement = $mysqli->prepare('INSERT INTO account (`email`, `password`, `salt`, `first_name`, `last_name`) VALUES (?, ?, ?, ?, ?)');
    if ($statement) {
        $statement->bind_param('sssss', $email, $password_sha512, $salt, $_POST['first_name'], $_POST['last_name']);
        $result = $statement->execute();
        $statement->close();
    }

    if (!$statement || !$result) {
        $mysqli->close();
        echo "An error occured while creating your account.";
        return;
    }

    $acc_id = $mysqli->insert_id;
    $address_statement = $mysqli->prepare('INSERT INTO address (`accountId`, `name`, `address`, `city`, `state`, `zip`) VALUES (?, ?, ?, ?, ?, ?)');
    if ($address_statement) {
        $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
        $address_statement->bind_param('issssi', $acc_id, $name, $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip']);
        $result = $address_statement->execute();
        $address_statement->close();
    }

    if (!$address_statement || !$result || !$mysqli->commit()) {
        echo "An error occured while creating your account.";
    } else {
        session_start();
        $_SESSION["userid"] = $acc_id;
        $_SESSION["name"] = $_POST['first_name'];
    }
}
$mysqli->close();
?>