<?php

require_once("mysql-config.php");

function getTotal($mysqli, $return_raw) {
    $total = 0;
    if (isset($_SESSION['cart']) && count($_SESSION['cart'])) {
        $result = $mysqli->query("SELECT itemId, price FROM cart WHERE accountId = {$_SESSION['userid']} AND itemId IN (" . implode(", ", array_keys($_SESSION['cart'])) . ")");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $total += $row['price'] * $_SESSION['cart'][$row['itemId']];
        }
        $result->close();
    }
    return $return_raw ? $total : number_format($total, 2, '.', ',');
}

function deleteFromCart($mysqli, $itemId) {
    unset($_SESSION['cart'][$itemId]);
    if (isset($_SESSION['userid'])) {
        $statement = $mysqli->prepare('DELETE FROM cart WHERE accountId = ? AND itemId = ?');
        if ($statement) {
            $statement->bind_param('ii', $_SESSION['userid'], $itemId);
            $result = $statement->execute();
            $statement->close();
        }
        if (!$statement || !$result) {
            return false;
        }
    }
    return true;
}

function updateCartDB($mysqli, $items) {
    if (isset($_SESSION['userid']) && count($items) > 0) {
        $itemValues = array();
        foreach ($items as $key => $value) {
            $itemValues[] = "({$_SESSION['userid']}, $key, $value)";
        }
        $result = $mysqli->query("INSERT INTO cart (accountId, itemId, quantity) VALUES " . implode(', ', $itemValues) . " ON DUPLICATE KEY UPDATE quantity = VALUES(quantity)");
        if (!$result) {
            return false;
        }
    }
    return true;
}

function syncCartSessionWithDB($mysqli, $accountId) {
    $mysqli->query("UPDATE cart INNER JOIN inventory ON cart.itemId = inventory.id SET cart.price = IF(cart.price <> inventory.price, inventory.price, cart.price) WHERE accountId = $accountId");
    $result = $mysqli->query("SELECT itemId, price, quantity FROM cart WHERE accountId = $accountId");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $_SESSION['cart'][$row['itemId']] = $row['quantity'];
    }
    $result->close();
}

function getAddressFromId($mysqli, $addrId) {
    $addr_result = $mysqli->query("SELECT name, address, city, state, zip FROM address WHERE id = $addrId AND accountId = {$_SESSION['userid']}");
    return $addr_result->fetch_array(MYSQLI_ASSOC);
}

function insertOrderItems($mysqli, $orderId, $closest_wh_id) {
    $keyString = implode(", ", array_keys($_SESSION['cart']));
    $itemsResult = $mysqli->query("INSERT INTO order_items (accountId, orderId, itemId, quantity, price) SELECT '{$_SESSION['userid']}', '$orderId', itemId, quantity, price FROM `cart` WHERE accountId = '{$_SESSION['userid']}' AND `itemId` IN (" . $keyString . ")");
    $deleteCartResult = $mysqli->query("DELETE FROM cart WHERE accountId = '{$_SESSION['userid']}' AND itemId IN (" . $keyString . ")");
    $quantity_update_statement = $mysqli->prepare("UPDATE inventory_quantity SET quantity = quantity - ? WHERE item_id = ? AND warehouse_id = ?");
    if ($quantity_update_statement) {
        $itemId = 0;
        $quantity = 0;
        $quantity_update_statement->bind_param('iii', $quantity, $itemId, $closest_wh_id);
        foreach ($_SESSION['cart'] as $key => $value) {
            $itemId = $key;
            $quantity = $value;
            $quantity_update_statement->execute();
        }
        $quantity_update_statement->close();
    }
    return $itemsResult && $deleteCartResult && $quantity_update_statement;
}

function insertMainOrder($mysqli, $address, $closest_wh_id, $last4, $speed) {
    $orderId = -1;
    $address_statement = $mysqli->prepare("INSERT INTO `order` (`accountId`, `name`, `address_pt1`, `address_pt2`, `warehouseId`, `total`, `last4`, `status`, `est_speed`) VALUES (?, ?, ?, ?, ?, ?, ?, 'SHIPPED', ?)");
    if ($address_statement) {
        $total = getTotal($mysqli, true);
        $addressPt2 = $address['city'] . ', ' . $address['state'] . ' ' . $address['zip'];
        $address_statement->bind_param('isssidid', $_SESSION['userid'], $address['name'], $address['address'], $addressPt2, $closest_wh_id, $total, $last4, $speed);
        $address_statement->execute();
        $address_statement->close();
        $orderId = $mysqli->insert_id;
    }
    return $orderId;
}

function placeOrder($mysqli, $addrId, $last4) {
    $address = getAddressFromId($mysqli, $addrId);
    $closest_wh = getClosestWarehouseId($mysqli, $address);
    $closest_wh_id = $closest_wh['warehouse_id'];
    $est_del_speed = $closest_wh['distance'] / $closest_wh['duration'];
    $mysqli->autocommit(false);
    $orderId = insertMainOrder($mysqli, $address, $closest_wh_id, $last4, $est_del_speed);
    if ($orderId != -1) {
        $insertResult = insertOrderItems($mysqli, $orderId, $closest_wh_id);
    }
    if ($orderId == -1 || !$insertResult || !$mysqli->commit()) {
        return ["success" => "false", "message" => "An error occured while placing your order."];
    } else {
        unset($_SESSION['cart']);
        $params['id'] = $orderId;
        $params['duration'] = $closest_wh['duration'];
        post_async('http://localhost/include/delayed-query.php', $params);
        return ["success" => "true", "order_id" => $orderId];
    }
}

function post_async($url, $params) {
    foreach ($params as $key => &$val) {
        if (is_array($val)) {
            $val = implode(',', $val);
        }
        $post_params[] = $key . '=' . urlencode($val);
    }
    $post_string = implode('&', $post_params);

    $parts = parse_url($url);

    $fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port'] : 80, $errno, $errstr, 30);

    $out = "POST " . $parts['path'] . " HTTP/1.1\r\n";
    $out.= "Host: " . $parts['host'] . "\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: " . strlen($post_string) . "\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) {
        $out.= $post_string;
    }

    fwrite($fp, $out);
    fclose($fp);
}

function getWarehouseAddresses($mysqli) {
    $queryWarehouses = $mysqli->query("SELECT id, lat, `long` FROM `warehouse_address`");
    $locations = array();
    while ($row = $queryWarehouses->fetch_array(MYSQLI_ASSOC)) {
        $row['latlng'] = $row['lat'] . ',' . $row['long'];
        $locations[] = $row;
    }
    $queryWarehouses->close();
    return $locations;
}

function getDrivingDistances($address, $locations) {
    $address_str = $address['address'] . '+' . $address['city'] . '+' . $address['state'];
    $address_google = str_replace(" ", "+", $address_str);
    $map_locs = implode('|', array_column($locations, 'latlng'));
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $map_locs . "&destinations=" . $address_google . "&departure_time=now&units=imperial&language=en&key=AIzaSyDmNrhRRBuvnxqNgPSluDN-PX59TbDWWBw";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

function getClosestWarehouseId($mysqli, $address) {
    $locations = getWarehouseAddresses($mysqli);
    $distances = getDrivingDistances($address, $locations)['rows'];
    $distance_vals = array();
    foreach ($distances as $distance) {
        $distance_vals[] = $distance['elements'][0]['distance']['value'];
    }
    $index = array_keys($distance_vals, min($distance_vals));
    $origin_row = $distances[$index[0]]['elements'][0];
    return ["warehouse_id" => $locations[$index[0]]['id'], "distance" => $origin_row['distance']['value'], "duration" => $origin_row['duration_in_traffic']['value']];
}

function updateCartItem($mysqli, $itemId, $new_quantity, $is_constant_quant) {
    $quantity_result = $mysqli->query("SELECT SUM(quantity) as quantity FROM inventory_quantity WHERE item_id = $itemId GROUP BY item_id");
    $quantity_remaining = mysqli_fetch_assoc($quantity_result)['quantity'];
    $cart_quant = $new_quantity;
    if (!$is_constant_quant && isset($_SESSION['cart'][$itemId])) {
        $cart_quant += $_SESSION['cart'][$itemId];
    }
    if ($quantity_remaining >= $cart_quant) {
        $_SESSION['cart'][$itemId] = $cart_quant;
        return true;
    }
    return false;
}

if (isset($_GET['action'])) {
    session_start();
    $mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
    if ($mysqli === null) {
        echo "An error occured while accessing the database.";
        return;
    }
    switch ($_GET['action']) {
        case "add":
            if (isset($_GET['item-id']) && isset($_GET['quantity']) && is_numeric($_GET['item-id']) && is_numeric($_GET['quantity'])) {
                $added = updateCartItem($mysqli, $_GET['item-id'], $_GET['quantity'], false);
                if ($added) {
                    if (isset($_SESSION['userid'])) {
                        $itemId = $_GET['item-id'];
                        $sql = "SET @price := (SELECT price FROM inventory WHERE id = $itemId); ";
                        $sql .= "INSERT INTO cart (accountId, itemId, price, quantity) VALUES ({$_SESSION['userid']}, $itemId, @price, {$_SESSION['cart'][$_GET['item-id']]}) ON DUPLICATE KEY UPDATE price = VALUES(price), quantity = VALUES(quantity)";
                        $result = $mysqli->multi_query($sql);
                        if (!$result) {
                            $mysqli->close();
                            echo "An error occured while adding to your cart.";
                            return;
                        }
                    }
                    $count = count($_SESSION['cart']);
                    if ($count > 0) {
                        echo array_sum(array_values($_SESSION['cart']));
                    }
                } else {
                    echo "There is not enough stock to add to cart.";
                }
            }
            break;
        case "remove":
            if (isset($_GET['item-id']) && is_numeric($_GET['item-id'])) {
                $success = deleteFromCart($mysqli, $_GET['item-id']);
                if ($success) {
                    echo json_encode(array("success" => "true", "count" => isset($_SESSION['cart']) ? array_sum(array_values($_SESSION['cart'])) : 0, "total" => getTotal($mysqli, false)));
                } else {
                    echo json_encode(array("success" => "false", "message" => "An error occured while deleting from your cart."));
                }
            }
            break;
        case "update":
            $newItems = json_decode($_POST['items']);
            $hasFailure = false;
            foreach ($newItems as $key => $value) {
                if (is_numeric($key) && is_numeric($value)) {
                    if ($value != 0) {
                        $updated = updateCartItem($mysqli, $key, $value, true);
                        if (!$updated) {
                            $hasFailure = true;
                        }
                    } else {
                        deleteFromCart($mysqli, $_SESSION['cart'][$key]);
                    }
                }
            }
            $count = 0;
            if (isset($_SESSION['cart'])) {
                updateCartDB($mysqli, $_SESSION['cart']);
                $count = array_sum(array_values($_SESSION['cart']));
            }
            if ($hasFailure) {
                echo json_encode(array("success" => "false", "message" => "One or more item could not be updated due to available stock.", "count" => $count, "total" => getTotal($mysqli, false)));
            } else {
                echo json_encode(array("success" => "true", "count" => $count, "total" => getTotal($mysqli, false)));
            }
            break;
    }
    $mysqli->close();
}
?>