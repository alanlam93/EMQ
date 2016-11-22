<?php
require 'include/header.php';

$itemid = $_GET['id'];

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while connecting to the database.";
    return;
}

$mysqli->set_charset("utf8");
$result = $mysqli->query("SELECT * FROM inventory WHERE id = $itemid");
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
}
$quantity_result = $mysqli->query("SELECT SUM(quantity) as quantity FROM inventory_quantity WHERE item_id = $itemid GROUP BY item_id");
$quantity = max(mysqli_fetch_assoc($quantity_result)['quantity'], 0);

$result = $mysqli->query("SELECT * FROM category WHERE id = $row[category_id]");
if ($result->num_rows > 0) {
    $row2 = mysqli_fetch_assoc($result);
}

//TODO: Handle product not found
$result->close();
$mysqli->close();
?>
<div class="container" style="margin-top:60px;">
    <div class="row">
        <!-- Title -->
        <ol class="breadcrumb">
            <li><a href="products.php">Products</a></li>
            <li><a href="products.php?cat-id=<?php echo $row['category_id'] ?>"><?php echo $row2['name'] ?></a></li> 
        </ol>
        <!--TODO: CATEGORIES -->
    </div>
    <div class="row">
        <div class="text-center col-md-6 col-md-offset-3" id="cart-notifications"></div>
    </div>
    <div class="row">
        <!-- Product Info-->
        <div class="col-xs-12 col-sm-6">
            <img src="./<? echo $row['img_src'] ?>" class="img-responsive product-image-large">
        </div>
        <div class="col-xs-12 col-sm-6">
            <h2 id="product-title">
                <? echo $row['name'] ?>
            </h2>
            <h3 id="model-num">
                Model: <? echo $row['model'] ?>
            </h3>
            <h4 id="quantity">
                Quantity Remaining: <? echo $quantity; ?>
                &emsp; 
                <? if($row['is_best_seller'] == 1) {echo '<img src="./img/bestseller.gif" />';}?>
            </h4>
            <div class="well row">
                <div class="input-group">
                    <div class="input-group-addon">Quantity:</div>
                    <input type="number" min="1" step="1" max="<?php echo $quantity; ?>" value="1" class="form-control" id="InputAmount" onkeypress="return isNumberKey(event);" onkeyup="this.value = minMax(this.value, 1, <?php echo $quantity; ?>)" placeholder="Amount">
                    <div class="input-group-addon">x $<? echo $row['price'] ?> USD</div>
                </div>
            </div>
            <div class="container-fluid">		
                <div class="col-md-12 product-info">
                    <ul id="myTab" class="nav nav-tabs nav_tabs">
                        <li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
                        <li><a href="#service-two" data-toggle="tab">PRODUCT FEATURES</a></li>
                        <li><a href="#service-three" data-toggle="tab">SPECIFICATIONS</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade in active" id="service-one">
                            <h4>Description</h4>
                            <p><? echo nl2br(htmlspecialchars($row['description'])) ?></p> 
                        </div>
                        <div class="tab-pane fade" id="service-two">
                            <h4>Features</h4>
                            <p><? echo htmlspecialchars($row['product_features']) ?></p>
                        </div>
                        <div class="tab-pane fade" id="service-three">
                            <h4>Specifications</h4>
                            <p><? echo htmlspecialchars($row['specifications']) ?></p>				
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="..." style="margin-bottom:10px;">
                <i class="add-cart"></i>
                <a type="button" href="javascript:void(0);" class="btn btn-default btn-success" onclick="addToCart(<?php echo $row['id']; ?>, getAmount());"><span class="fa fa-plus"></span>&nbsp;Add to Cart</a>
                <!--TODO:ADD TO CART WITH Quantity-->
                <a type="button" class="btn btn-default btn-info" href="index.php"><span class="fa fa-close"></span>&nbsp;Keep Shopping</a>
            </div>
        </div>
    </div>
</div>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode !== 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function minMax(value, min, max) {
        if (parseInt(value) < min || isNaN(parseInt(value)))
            return 1;
        else if(parseInt(value) > max)
            return max;
        return value;
    }

    function getAmount() {
        var value = document.getElementById("InputAmount").value;
        if (value.length === 0) {
            return 1;
        }
        return value;
    }
</script>
<?php require 'include/footer.php'; ?>