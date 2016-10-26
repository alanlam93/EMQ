<?php

require_once("mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An unknown error occured.";
    return;
}
session_start();
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
    default:
        echo "An unknown error occured.";
        break;
}
$mysqli->close();
?>