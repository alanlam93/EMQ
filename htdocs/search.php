<?php require 'include/header.php'; 
	$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
	if ($mysqli === null) {
	echo "An error occured while connecting to the database.";
	return;
	}

	$searchTerms = $_GET['srch-term'];

	$parsedTerms = explode(" ",$searchTerms);

	$searchQuery = "SELECT id, name, price, brand, img_src FROM inventory WHERE name LIKE '%".$searchTerms."%'";
	foreach($parsedTerms as $pT){
		$searchQuery .= " OR name LIKE '%$pT%' ";
	}

	$result = $mysqli->query($searchQuery);
	$matchedProducts = array();

	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$matchedProducts[] = $row;
	}
	

	$result->close();
	$mysqli->close();
?>
<style>
#catTitle{
text-align: center;
}
.product_container{
height: 500px;
margin-top: 5%;
margin-right: 10%;
text-align: center;
}
.filter{
margin-right: 20px;
border-right: 1px  solid #bfbfbf;
text-align: left;
}
.filterList{
list-style-type: none;
}
.label{
font-weight: normal;
}
.product_grid{
margin-left: 100px;
}
.product-row{
margin-top: 20px;
text-align: left;
}

.panel-footer{
overflow: hidden;
}
</style>
<h3 id="catTitle"><?php echo $categoryName; ?></h3><br>
<div class="container-fluid">
    <div class="filter col-md-2 responsive hidden-xs hidden-sm">
        <ul class="filterList">
            <li><h4>Brand</h4></li>
            <li><input name="brand1" id="brand1" data-id="Apple" class="brands" type="checkbox" /> Apple</li>
            <li><input name="brand2" id="brand2" data-id="ASUS" class="brands" type="checkbox" /> ASUS</li>
            <li><input name="brand3" id="brand3" data-id="Bose" class="brands" type="checkbox" /> Bose</li>
            <li><input name="brand4" id="brand4" data-id="Canon" class="brands" type="checkbox" /> Canon</li>
            <li><input name="brand5" id="brand5" data-id="DJI" class="brands" type="checkbox" /> DJI</li>
            <li><input name="brand6" id="brand6" data-id="Epson" class="brands" type="checkbox" /> Epson</li>
            <li><input name="brand7" id="brand7" data-id="Fitbit" class="brands" type="checkbox" /> Fitbit</li>
            <li><input name="brand8" id="brand8" data-id="HP" class="brands" type="checkbox" /> HP</li>
            <li><input name="brand9" id="brand9" data-id="Intel" class="brands" type="checkbox" /> Intel</li>
            <li><input name="brand10" id="brand10" data-id="Logitech" class="brands" type="checkbox" /> Logitech</li>
            <li><input name="brand11" id="brand11" data-id="Nvidia" class="brands" type="checkbox" /> Nvidia</li>
            <li><input name="brand12" id="brand12" data-id="Samsung" class="brands" type="checkbox" /> Samsung</li>
            <li><input name="brand13" id="brand13" data-id="Sennheiser" class="brands" type="checkbox" /> Sennheiser</li>
            <li><input name="brand14" id="brand14" data-id="Vizio" class="brands" type="checkbox" /> Vizio</li>
           
            <li><h4>Price</h4></li>
            <li><input type="checkbox" price-id="0" name="pricecheckbox" class="prices"> Under $100</li>
            <li><input type="checkbox" price-id="100" name="pricecheckbox" class="prices"> $100-$200</li>
            <li><input type="checkbox" price-id="200" name="pricecheckbox" class="prices"> $200-$300</li>
            <li><input type="checkbox" price-id="300" name="pricecheckbox" class="prices"> $300-$400</li>
            <li><input type="checkbox" price-id="400" name="pricecheckbox" class="prices"> $400-$500</li>
            <li><input type="checkbox" price-id="500" name="pricecheckbox" class="prices"> More than $500</li>
             <li>
                <br>
                <button type="button" onclick='uncheckAll()' class="btn btn-primary btn-sm">Clear</button>
            </li>
        </ul>
    </div>

    <div class="container-fluid col-md-9">
        <div class="row">
            <?php foreach ($matchedProducts as $item): ?>
            <div class="container col-md-3" id="productPanel" brand="<?php echo htmlspecialchars($item['brand']); ?>"  data-price="<?php $priceVal = (float)$item['price']; 
                    if($priceVal > 500) { $priceVal = 500; } 
                    else{$priceVal = $priceVal/100; $priceVal = floor($priceVal); $priceVal = $priceVal * 100;}
                    echo htmlspecialchars($priceVal); ?>">

                <div class="panel panel-default"  style="max-width: 300px; float: left">
                    <div class="panel-body panel-image" style="max-height: 250px;">
                        <a href="product.php?id=<?php echo $item['id']; ?>">
                            <img src="./<?php echo $item['img_src']; ?>" class="img-responsive center-block" style="max-height: 200px;" alt="<?php echo htmlspecialchars($item['name']); ?>" />
                        </a>
                    </div>
                    <div class="panel-footer" style="background-color: white; font-size:medium; height: 80px;"><a class="title" href="product.php?id=<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></a></div>
                    <div class="clearfix"></div>
                    <div class="panel-footer" style="background-color: white;">$<?php echo $item['price']; ?></div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo"></span>
                                <i class="add-cart"></i><a href="javascript:void(0);" onclick="addToCart(<?php echo $item['id']; ?>, 1);">Add to cart</a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="btn-more">
                                <span class="glyphicon glyphicon-th-list more-list"></span>
                                <a href="#" class="">View More</a>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <?php if ((++$rowCount % 4 == 0)) { echo '    <div class="clearfix"></div>' . "\n                        "; } endforeach; ?></div>
        </div>
    </div>
    <script type="text/javascript">
    $(function(){
        $('.prices, .brands').on('click', function(){
            var checkedPrices = $('.prices:checked');
            var checkedBrands = $('.brands:checked');
        if(checkedPrices.length || checkedBrands.length){
            if(checkedBrands.length === 0){
                $('.row > div').hide();
                $.each(checkedPrices, function(){
                var priceId = $(this).attr('price-id');
                $('.row > div[data-price="' + priceId + '"]').show();
                });
                } 
            else if(checkedPrices.length === 0) {
                $('.row > div').hide();
                $.each(checkedBrands, function(){
                var brandId = $(this).attr('data-id');
                $('.row > div[brand="' + brandId + '"]').show();
                });
            } else {
                $('.row > div').hide();
                $.each(checkedPrices, function(){
                var priceId = $(this).attr('price-id');
                $.each(checkedBrands, function(){
                var brandId = $(this).attr('data-id');
                $('.row > div[data-price="' + priceId + '"][brand="' + brandId + '"]').show();
                });
             });
            }
            } 
        else {
             $('.row > div').show();
        }
        });
    });

    function uncheckAll(){
        $("input[type='checkbox']:checked").prop("checked",false)
        $('.row > div').show();
    }
    </script>
    <?php require 'include/footer.php'; ?>