<?php

require_once("mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An unknown error occured.";
    return;
}
session_start();
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "change_pass":
            if (isset($_POST['old'], $_POST['new'], $_POST['new_verify'])) {
                if ($_POST['new'] !== $_POST['new_verify']) {
                    echo "New password does not match.";
                } else {
                    $userId = $_SESSION["userid"];
                    $result = $mysqli->query("SELECT * from account WHERE `id` = $userId");
                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['password'] == hash('sha512', $_POST['old'] . $row['salt'])) {
                            $salt = substr(hash('sha1', uniqid(rand(), true)), 0, 32);
                            $password_sha512 = hash('sha512', $_POST['new'] . $salt);
                            $statement = $mysqli->prepare('UPDATE account SET `password` = ?, `salt` = ? WHERE id = ?');
                            if ($statement) {
                                $statement->bind_param('ssi', $password_sha512, $salt, $userId);
                                $result = $statement->execute();
                                $statement->close();
                            }
                            if (!$result) {
                                echo "An error occured while changing your password.";
                            }
                        } else {
                            echo "Your current password is incorrect.";
                        }
                    } else {
                        echo "An unknown error occured.";
                    }
                }
            }
            break;
        case "add_address":
            if (isset($_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['set-default'])) {
                $acc_id = $_SESSION["userid"];
                $address_statement = $mysqli->prepare('INSERT INTO address (`accountId`, `name`, `address`, `city`, `state`, `zip`) VALUES (?, ?, ?, ?, ?, ?)');
                if ($address_statement) {
                    $address_statement->bind_param('issssi', $acc_id, $_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip']);
                    $result = $address_statement->execute();
                    $address_statement->close();
                }
                if (!$result) {
                    echo json_encode(array("success" => "false", "message" => "An error occured while adding your address."));
                } else {
                    $addr_id = $mysqli->insert_id;
                    if ($_POST['set-default'] === "Yes") {
                        $result = $mysqli->query("UPDATE account SET default_addr_id = $addr_id WHERE id = $acc_id");
                        if (!$result) {
                            echo json_encode(array("success" => "false", "message" => "An error occured while setting your default address."));
                        }
                    }
                    if ($result) {
                        echo json_encode(array("success" => "true", "addr_id" => $addr_id,
                            "addr_js" => "{\"id\":\"$addr_id\",\"name\":\"{$_POST['name']}\",\"address\":\"{$_POST['address']}\",\"city\":\"{$_POST['city']}\",\"state\":\"{$_POST['state']}\",\"zip\":\"{$_POST['zip']}\"}",
                            "addr_str" => $_POST['name'] . ', ' . $_POST['address'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ' ' . $_POST['zip']));
                    }
                }
            }
            break;
        default:
            echo "An unknown action was specified.";
            break;
    }
}
$mysqli->close();
?>