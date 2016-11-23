<?php
session_start();

if (!isset($_SESSION['userid']) || !isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
    header('Location: index.php');
    return;
}

require_once("include/mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while accessing the database.";
    return;
}

$order = null;
if (isset($_POST['ship-addr-id'], $_POST['card-num'], $_SESSION['cart']) && count($_SESSION['cart'])) {
    include("include/cart-actions.php");
    $order = placeOrder($mysqli, $mysqli->real_escape_string($_POST['ship-addr-id']), substr($_POST['card-num'], -4));
    $orderId = $order['order_id'];
}

$items = array();
if ($order["success"]) {
    $mysqli->set_charset("utf8");
    $result = $mysqli->query("SELECT itemId, name, quantity, order_items.price FROM order_items INNER JOIN inventory ON order_items.itemId = id WHERE orderId = $orderId");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $items[] = $row;
    }
    $result->close();

    $orderResult = $mysqli->query("SELECT id, name, address_pt1, address_pt2, total, last4, date FROM `order` WHERE id = $orderId");
    $orderDetails = $orderResult->fetch_array(MYSQLI_ASSOC);
}
$mysqli->close();

require("include/header.php");
?>
                <div class="container">
                    <div class="order-summary col-sm-6 col-md-8 col-lg-8 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                        <?php if ($order["success"]) : ?><div class="panel panel-primary">
                            <div class="panel panel-heading" style="margin-bottom: 0px;">
                                <h3>Order #<?php echo $orderId ?></h3>
                            </div>
                            <div class="panel-body">
                                <h4>Thank you, <?php echo $_SESSION['name'] ?>. Your order has been successfully completed.</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">Ship To:</div>
                                    <div class="col-md-10"><?php echo $orderDetails['name'] ?><br /><?php echo $orderDetails['address_pt1'] ?><br /><?php echo $orderDetails['address_pt2']; ?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">Payment:</div>
                                    <div class="col-md-10">Card ending in <?php echo $orderDetails['last4']; ?></div>
                                </div>
                                <hr>
                                <a href="tracking.php?order=<?php echo $orderId ?>">Click here for tracking information</a></h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-10"><h3>Details of Order</h3></div>
                                    <div class="col-xs-6 col-md-8"><h4>Item</h4></div>
                                    <div class="col-xs-3 col-md-2"><h4>Quantity</h4></div>
                                    <div class="col-xs-3 col-md-2"><h4>Price</h4></div>
                                </div>
                                <?php foreach ($items as $item): ?><div class="row" style="margin-bottom: 10px;">
                                    <div class="col-xs-6 col-md-8"><a href="product.php?id=<?php echo $item['itemId']; ?>"><?php echo htmlspecialchars($item['name']); ?></a></div>
                                    <div class="col-xs-3 col-md-2"><?php echo $item['quantity']; ?></div>
                                    <div class="col-xs-3 col-md-2">$<?php echo $item['price']; ?></div>
                                </div>
                                <?php endforeach; ?><hr>
                                <div class="row">
                                    <div class="col-xs-8 col-md-10"><h4>Total:</h4></div>
                                    <div class="col-xs-4 col-md-2"><h4>$<?php echo number_format($$orderDetails['total'], 2, '.', ','); ?></h4></div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="pull-right">
                                    <a class="btn btn-large btn-primary" href="index.php">Back to Home</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    <?php else : ?><div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title">Error</h3>
                            </div>
                            <div class="panel-body">An error occurred while placing your order. Please try again later.</div>
                            <div class="panel-footer">
                                <div class="pull-right">
                                    <a class="btn btn-large btn-primary" href="index.php">Back to Home</a>
                                </div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                    <?php endif; ?></div>
                </div>
<?php require 'include/footer.php'; ?>