<?php
require 'include/header.php';
if (!isset($_SESSION['userid']) || !isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
    header('Location: index.php');
}

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while logging in.";
    return;
}

if (isset($_POST['ship-addr-id'], $_POST['card-num'], $_SESSION['cart']) && count($_SESSION['cart'])) {
    include("include/cart-actions.php");
    placeOrder($mysqli, $mysqli->real_escape_string($_POST['ship-addr-id']), substr($_POST['card-num'], -4));
}

/*$total = 0;
$cart = array();
$mysqli->set_charset("utf8");
$cartQuery = "SELECT id, name, description, price, img_src FROM inventory WHERE id IN (" . implode(", ", array_keys($_SESSION['cart'])) . ")";
$result = $mysqli->query($cartQuery);
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $row['quantity'] = $_SESSION['cart'][$row['id']];
    $total += $row['price'] * $row['quantity'];
    $cart[] = $row;
}
$result->close();

$addresses = array();
$result = $mysqli->query("SELECT default_addr_id, address.id, `name`, address, city, state, zip FROM account INNER JOIN address ON account.id = address.accountId WHERE accountId = '{$_SESSION['userid']}'");
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $addresses[] = $row;
}*/
$mysqli->close();
?>
<div class="container">
    <div class="order-summary col-sm-6 col-md-8 col-lg-8 col-sm-offset-3 col-md-offset-2 col-lg-offset-2" id="step4summary">
        <div class="panel panel-primary">
            <div class="panel panel-heading">
                <h3>Order #123875231</h3>
            </div>

            <div class="panel panel-body">
                <div class="tracking-Info">
                    <h4>Thank you, USER. Your order has been successfully completed. </h4>
                    <h4>Your Tracking #12392139321 <br><br><a href="tracking.php">Click here for tracking information</a></h4>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-10">
                        <h3>Details of Order</h3>
                    </div>
                    <div class="col-xs-6 col-md-8">
                        <h4>Item</h4>
                    </div>
                    <div class="col-xs-3 col-md-2">
                        <h4>Quantity</h4>
                    </div>
                    <div class="col-xs-3 col-md-2">
                        <h4>Price</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-md-2">
                        Image(?) 
                    </div>
                    <div class="col-xs-3 col-md-6">
                        Item Name
                    </div>
                    <div class="col-xs-3 col-md-2">
                        Quantity
                    </div>
                    <div class="col-xs-3 col-md-2">
                        Price
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-md-2">
                        Image(?) 
                    </div>
                    <div class="col-xs-3 col-md-6">
                        Item Name
                    </div>
                    <div class="col-xs-3 col-md-2">
                        Quantity
                    </div>
                    <div class="col-xs-3 col-md-2">
                        Price
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-8 col-md-10">
                        <h4>Total:</h4>
                    </div>
                    <div class="col-xs-4 col-md-2">
                        <h4>$1234.12</h4>
                    </div>
                </div>
                <div class="col-md-2 col-xs-offset-7 col-md-offset-10">
                    <br>
                    <a class="btn btn-large btn-primary" href="index.php">Back to Home</a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php require 'include/footer.php'; ?>
