<?php

require_once("mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An unknown error occured.";
    return;
}
session_start();
$acc_id = $_SESSION["userid"];
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case "change_name":
            if (isset($_POST['first_name'], $_POST['last_name'])) {
                $update_name_statement = $mysqli->prepare('UPDATE account SET `first_name` = ?, `last_name` = ? WHERE id = ?');
                if ($update_name_statement) {
                    $update_name_statement->bind_param('ssi', $_POST['first_name'], $_POST['last_name'], $acc_id);
                    $result = $update_name_statement->execute();
                    $update_name_statement->close();
                }
                if (!$update_name_statement || !$result) {
                    $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while updating your name."));
                } else {
                    $_SESSION["name"] = $_POST['first_name'];
                    $account_action_res = json_encode(array("success" => "true", "message" => "Your name has been updated."));
                }
            }
            break;
        case "change_pass":
            if (isset($_POST['old'], $_POST['new'], $_POST['new_verify'])) {
                if ($_POST['new'] !== $_POST['new_verify']) {
                    echo "New password does not match.";
                } else {
                    $result = $mysqli->query("SELECT * from account WHERE `id` = $acc_id");
                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row['password'] == hash('sha512', $_POST['old'] . $row['salt'])) {
                            $salt = substr(hash('sha1', uniqid(rand(), true)), 0, 32);
                            $password_sha512 = hash('sha512', $_POST['new'] . $salt);
                            $statement = $mysqli->prepare('UPDATE account SET `password` = ?, `salt` = ? WHERE id = ?');
                            if ($statement) {
                                $statement->bind_param('ssi', $password_sha512, $salt, $acc_id);
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
        case "change_email":
            if (isset($_POST['email'])) {
                $email_update_statement = $mysqli->prepare('UPDATE account SET `email` = ? WHERE id = ?');
                if ($email_update_statement) {
                    $email_update_statement->bind_param('si', $_POST['email'], $acc_id);
                    $result = $email_update_statement->execute();
                    $email_update_statement->close();
                }
                if (!$email_update_statement || !$result) {
                    $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while updating your email."));
                } else {
                    $account_action_res = json_encode(array("success" => "true", "message" => "Your email has been updated."));
                }
            }
            break;
        case "add_address":
            if (isset($_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['set-default'])) {
                $address_statement = $mysqli->prepare('INSERT INTO address (`accountId`, `name`, `address`, `city`, `state`, `zip`) VALUES (?, ?, ?, ?, ?, ?)');
                if ($address_statement) {
                    $address_statement->bind_param('issssi', $acc_id, $_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip']);
                    $result = $address_statement->execute();
                    $address_statement->close();
                }
                if (!$result) {
                    $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while adding your address."));
                    if (isset($_POST['ajax'])) {
                        echo $account_action_res;
                    }
                } else {
                    $addr_id = $mysqli->insert_id;
                    $is_default = $_POST['set-default'] === "Yes";
                    if ($is_default) {
                        $result = $mysqli->query("UPDATE account SET default_addr_id = $addr_id WHERE id = $acc_id");
                        if (!$result) {
                            $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while setting your default address."));
                            if (isset($_POST['ajax'])) {
                                echo $account_action_res;
                            }
                        }
                    }
                    if ($result) {
                        $account_action_res = json_encode(array("success" => "true", "message" => "Your new address has been added.", "addr_id" => $addr_id,
                            "addr_js" => "{\"id\":\"$addr_id\",\"name\":\"{$_POST['name']}\",\"address\":\"{$_POST['address']}\",\"city\":\"{$_POST['city']}\",\"state\":\"{$_POST['state']}\",\"zip\":\"{$_POST['zip']}\"}",
                            "addr_str" => $_POST['name'] . ', ' . $_POST['address'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ' ' . $_POST['zip'],
                            "is_default" => $is_default));
                        if (isset($_POST['ajax'])) {
                            echo $account_action_res;
                        }
                    }
                }
            }
            break;
        case "edit_address":
            if (isset($_POST['addressId'], $_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip']) && is_numeric($_POST['addressId'])) {
                $addr_id = $_POST['addressId'];
                $address_statement = $mysqli->prepare('UPDATE address SET `name` = ?, `address` = ?, `city` = ?, `state` = ?, `zip` = ? WHERE id = ? AND accountId = ?');
                if ($address_statement) {
                    $address_statement->bind_param('ssssiii', $_POST['name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $addr_id, $acc_id);
                    $result = $address_statement->execute();
                    $address_statement->close();
                }
                if (!$address_statement || !$result) {
                    $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while updating the address."));
                } else {
                    $account_action_res = json_encode(array("success" => "true", "message" => "Your address has been updated."));
                }
            }
            break;
        case "del_address":
            if (isset($_POST['addressId']) && is_numeric($_POST['addressId'])) {
                $new_addr_id = $_POST['addressId'];
                $result = $mysqli->query("DELETE FROM address WHERE accountId = $acc_id AND id = $new_addr_id");
                if (!$result) {
                    $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while deleting the address."));
                } else {
                    $account_action_res = json_encode(array("success" => "true", "message" => "Your address has been deleted."));
                }
            }
            break;
        case "set_def_address":
            if (isset($_POST['addressId']) && is_numeric($_POST['addressId'])) {
                $new_addr_id = $_POST['addressId'];
                $result = $mysqli->query("UPDATE account SET default_addr_id = $new_addr_id WHERE id = $acc_id");
                if (!$result) {
                    $account_action_res = json_encode(array("success" => "false", "message" => "An error occured while setting your default address."));
                } else {
                    $account_action_res = json_encode(array("success" => "true", "message" => "Your default address has been changed."));
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