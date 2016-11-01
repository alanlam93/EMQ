<?php

session_start();
require_once("mysql-config.php");
$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while accessing the database.";
    return;
}

switch ($_GET['action']) {
    case "add":
        if (isset($_GET['item-id']) && isset($_GET['quantity']) && is_numeric($_GET['item-id']) && is_numeric($_GET['quantity'])) {
            if (isset($_SESSION['cart'][$_GET['item-id']])) {
                $_SESSION['cart'][$_GET['item-id']] += $_GET['quantity'];
            } else {
                $_SESSION['cart'][$_GET['item-id']] = $_GET['quantity'];
            }

            if (isset($_SESSION['userid'])) {
                require_once("mysql-config.php");


                $statement = $mysqli->prepare('INSERT INTO cart (`accountId`, `itemId`, `quantity`) VALUES (?, ?, ?)');
                if ($statement) {
                    $statement->bind_param('iii', $_SESSION['userid'], $_GET['item-id'], $_GET['quantity']);
                    $result = $statement->execute();
                    $statement->close();
                }

                if (!$statement || !$result) {
                    $mysqli->close();
                    echo "An error occured while adding to your cart.";
                    return;
                }
                $mysqli->close();
            }
            $count = count($_SESSION['cart']);
            if ($count > 0) {
                echo array_sum(array_values($_SESSION['cart']));
            }
        }
        break;
    case "remove":
        if (isset($_GET['item-id']) && is_numeric($_GET['item-id'])) {
            unset($_SESSION['cart'][$_GET['item-id']]);

            if (isset($_SESSION['userid'])) {
                $statement = $mysqli->prepare('DELETE FROM cart WHERE accountId = ? AND itemId = ?');
                if ($statement) {
                    $statement->bind_param('ii', $_SESSION['userid'], $_GET['item-id']);
                    $result = $statement->execute();
                    $statement->close();
                }

                if (!$statement || !$result) {
                    $mysqli->close();
                    echo json_encode(array("success" => "false", "message" => "An error occured while deleting from your cart."));
                    return;
                }
                $mysqli->close();
            }
            echo json_encode(array("success" => "true", "count" => isset($_SESSION['cart']) ? array_sum(array_values($_SESSION['cart'])) : 0, "total" => getTotal($mysqli)));
        }
        break;
    case "update":
        unset($_SESSION['cart']);
        $newItems = json_decode($_POST['items']);
        foreach ($newItems as $key => $value) {
            if ($value != 0) {
                $_SESSION['cart'][$key] = $value;
            }
        }
        $count = count($_SESSION['cart']);
        echo json_encode(array("success" => "true", "count" => isset($_SESSION['cart']) ? array_sum(array_values($_SESSION['cart'])) : 0, "total" => getTotal($mysqli)));
        break;
}

function getTotal($mysqli) {
    $cart = array();
    $total = 0;
    if (isset($_SESSION['cart']) && count($_SESSION['cart'])) {
        $cartQuery = "SELECT id, price FROM inventory WHERE id IN (" . implode(", ", array_keys($_SESSION['cart'])) . ")";
        $result = $mysqli->query($cartQuery);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $total += $row['price'] * $_SESSION['cart'][$row['id']];
        }
        $result->close();
    }
    return $total;
}

$mysqli->close();
?>