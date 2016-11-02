<?php
require('include/header.php');

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while connecting to the database.";
    return;
}
$mysqli->set_charset("utf8");
$cart = array();
$total = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart'])) {
    $cartQuery = "SELECT id, name, description, price, img_src FROM inventory WHERE id IN (" . implode(", ", array_keys($_SESSION['cart'])) . ")";
    $result = $mysqli->query($cartQuery);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $total += $row['price'] * $row['quantity'];
        $cart[] = $row;
    }
    $result->close();
}
$mysqli->close();
?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                    </div>
                                    <div class="col-xs-6">
                                        <button type="button" onclick="location.href = 'index.php';" class="btn btn-primary btn-sm btn-block">
                                            <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                        </button>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="text-center col-md-6 col-md-offset-3" id="cart-notifications"></div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($cart as $item): ?><div class="row cart-item">
                                    <div class="col-xs-2"><img class="img-responsive" src="/<?php echo $item['img_src']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                    </div>
                                    <div class="col-xs-4">
                                        <h4 class="product-name"><strong><?php echo htmlspecialchars($item['name']); ?></strong></h4><h4><small><?php echo htmlspecialchars($item['description']); ?></small></h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-6 text-right">
                                            <h6><strong>$<?php echo $item['price']; ?> <span class="text-muted">x</span></strong></h6>
                                        </div>
                                        <div class="col-xs-4">
                                            <input type="text" class="form-control input-sm" value="<?php echo $item['quantity']; ?>">
                                        </div>
                                        <div class="col-xs-2">
                                            <button id="<?php echo $item['id']; ?>" type="button" class="rem-item btn btn-link btn-xs">
                                                <span class="glyphicon glyphicon-trash"> </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                            <div class="row">
                                <div class="text-center">
                                    <div class="col-xs-9">
                                        <h6 class="text-right">Changed any items?</h6>
                                    </div>
                                    <div class="col-xs-3">
                                        <button id="update-cart" type="button" class="btn btn-default btn-sm btn-block">
                                            Update Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row text-center">
                                <div class="col-xs-9">
                                    <h4 class="text-right">Total <strong id="tot-price">$<?php echo $total; ?></strong></h4>
                                </div>
                                <div class="col-xs-3">
                                    <button type="button" class="btn btn-success btn-block">
                                        Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(".rem-item").click(function () {
                var id = $(this).attr('id');
                var row = $(this).closest('.row');
                $.ajax({
                    type: "GET",
                    url: "include/cart-actions.php?action=remove&item-id=" + id,
                    success: function (msg) {
                        var retData = JSON.parse(msg);
                        $("#cart-notifications").html(getErrorMessage(msg));
                        if (retData.success) {
                            $("#cart-notifications").html(getSuccessMessage("The item was removed."));
                            $(".badge").html(retData.count > 0 ? retData.count : "");
                            $("#tot-price").html("$" + retData.total);
                            row.next().remove();
                            row.remove();
                        } else {
                            $("#cart-notifications").html(getErrorMessage(retData.message));
                        }
                    },
                    error: function () {
                        $("#cart-notifications").html(getErrorMessage("An error occured while removing from your cart."));
                    }
                });
            });
            $("#update-cart").click(function () {
                var arr = {};
                $(this).closest('.panel-body').children('.cart-item').each(function () {
                    var quantity = $(this).find('input:text').val();
                    if (quantity !== "0")
                        arr[$(this).find('.rem-item').attr('id')] = $(this).find('input:text').val();
                    else
                        $(this).remove();
                });
                $.ajax({
                    type: "POST",
                    url: "include/cart-actions.php?action=update",
                    data: "items=" + JSON.stringify(arr),
                    success: function (msg) {
                        var retData = JSON.parse(msg);
                        $("#cart-notifications").html(getErrorMessage(msg));
                        if (retData.success) {
                            $("#cart-notifications").html(getSuccessMessage("Your cart was updated."));
                            $(".badge").html(retData.count > 0 ? retData.count : "");
                            $("#tot-price").html("$" + retData.total);
                        } else {
                            $("#cart-notifications").html(getErrorMessage(retData.message));
                        }
                    },
                    error: function () {
                        $("#cart-notifications").html(getErrorMessage("An error occured while updating your cart."));
                    }
                });
            });
        </script>
<?php require 'include/footer.php'; ?>