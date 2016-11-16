<?php

session_start();

if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
    return;
}

require_once("include/mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while accessing the database.";
    return;
}

$accountId = $_SESSION['userid'];
$orders = array();
$mysqli->set_charset("utf8");
$result = $mysqli->query("SELECT orderId, itemId, inventory.name, img_src, quantity, order_items.price, total, date, address.name AS address_name, address, city, state, zip FROM order_items INNER JOIN `order` ON `order`.id = order_items.orderId INNER JOIN address ON order.addressId = address.id INNER JOIN inventory ON order_items.itemId = inventory.id WHERE order.accountId = $accountId ORDER BY orderId, inventory.name");
$lastOrder = null;
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    if (empty($orders) || !empty($lastOrder) && $lastOrder['orderId'] != $row['orderId']) {
        if (!empty($lastOrder)) {
            $orders[] = $lastOrder;
        }
        $phpdate = strtotime($row['date']);
        $formattedDate = date('F j, Y', $phpdate);
        $lastOrder = ["orderId" => $row['orderId'], "total" => $row['total'], "date" => $formattedDate, "address_name" => $row['address_name'], "address" => $row['address'], "city" => $row['city'], "state" => $row['state'], "zip" => $row['zip']];
        $lastOrder['items'][] = ["itemId" => $row['itemId'], "name" => $row['name'], "img_src" => $row['img_src'], "quantity" => $row['quantity'], "price" => $row['price']];
    } else {
        $lastOrder['items'][] = ["itemId" => $row['itemId'], "name" => $row['name'], "img_src" => $row['img_src'], "quantity" => $row['quantity'], "price" => $row['price']];
    }
}
if (!empty($lastOrder)) {
    $orders[] = $lastOrder;
}
$result->close();
$mysqli->close();

require("include/header.php");
?>
                <style>
                    .tooltip-inner {
                        max-width: 300px;
                        width: 150px;
                    }
                </style>
                <div class="container">
                    <div class="col-sm-6 col-md-8 col-lg-8 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                        <h2>Order History</h2>
                        <?php foreach ($orders as $order): ?>    <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-lg-3 small">Order Placed</div>
                                    <div class="col-lg-2 small">Total</div>
                                    <div class="col-lg-2 small">Ship To</div>
                                    <div class="col-lg-3 col-lg-offset-2 text-right small">Order Number</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 small"><?php echo $order['date']; ?></div>
                                    <div class="col-lg-2 small">$<?php echo $order['total']; ?></div>
                                    <div class="col-lg-2 small">
                                        <span data-toggle="tooltip" data-html="true" data-placement="bottom" title="<address><strong><?php echo $order['address_name']; ?></strong><br/><?php echo $order['address']; ?><br/><?php echo $order['city']; ?>, <?php echo $order['state']; ?> <?php echo $order['zip']; ?></address>"><?php echo $order['address_name']; ?><span class="caret"></span></span>
                                    </div>
                                    <div class="col-lg-3 col-lg-offset-2 text-right small"><?php echo $order['orderId']; ?></div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <?php foreach ($order['items'] as $item): ?>    <div class="row" style="margin-bottom: 20px;">
                                            <div class="col-lg-3"><a href="product.php?id=<?php echo $item['itemId']; ?>"><img class="img-responsive" src="<?php echo $item['img_src']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></a></div>
                                            <div class="col-lg-9">
                                                <strong style="font-size:14px;"><a href="product.php?id=<?php echo $item['itemId']; ?>"><?php echo htmlspecialchars($item['name']); ?></a></strong><br/>
                                                <strong style="font-size:12px;">Price: $<?php echo $item['price']; ?></strong><br/>
                                                <strong style="font-size:12px;">Quantity: <?php echo $item['quantity']; ?></strong>
                                            </div>
                                        </div>
                                    <?php endforeach; ?></div>
                                    <div class="col-lg-4">
                                        <a href="tracking.php?order=<?php echo $order['orderId']; ?>" class="btn btn-primary pull-right" role="button">Track Package</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?></div>
                </div>
                <script>
                    $(function () {
                        $("[data-toggle='tooltip']").tooltip();
                    });
                </script>
<?php require 'include/footer.php'; ?>