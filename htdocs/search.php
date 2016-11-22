<?php require 'include/header.php'; 
	$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
	if ($mysqli === null) {
	echo "An error occured while connecting to the database.";
	return;
	}
	
	$mysqli->set_charset("utf8");
	
    //Get terms from search
    $searchTerms = $_GET['srch-term'];
    //Parse terms by ' '
	$parsedTerms = explode(" ",$searchTerms);

    //Queries products with term in name
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

<link rel="stylesheet" href="css/products.css">

    <!-- Mobile Filter Nav Bar -->
    <nav class="navbar navbar-default navbar-static visible-xs" id="filterNav">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#filterBar">
                            <span class="glyphicon glyphicon-plus"></span>
                   
                        </button>      
                         <h3 style="display: block; margin-left: 5%;">Filter</h3>                 
                    </div>
                    <div class="collapse navbar-collapse" id="filterBar">
                        <ul class="nav navbar-nav col-xs-6" id="brandNav">
                            <li><h4><b>Brand</b></h4></li>
                            <?php foreach ($allBrands as $brand): ?>
                                <li><label><input data-id="<?php echo $brand['name']; ?>" class="brands" type="checkbox" /> <?php echo $brand['name']; ?></label></li>
                            <?php  endforeach ?>
                        </ul>
                        <ul class="nav navbar-nav col-xs-6" id="priceNav">
                             <li><h4><b>Price</b></h4></li>
                            <li><label><input type="checkbox" price-id="0" class="prices"> Under $100</label></li>
                            <li><label><input type="checkbox" price-id="100" class="prices"> $100-$200</label></li>
                            <li><label><input type="checkbox" price-id="200" class="prices"> $200-$300</label></li>
                            <li><label><input type="checkbox" price-id="300" class="prices"> $300-$400</label></li>
                            <li><label><input type="checkbox" price-id="400" class="prices"> $400-$500</label></li>
                            <li><label><input type="checkbox" price-id="500" class="prices"> More than $500</label></li>
                             <li>
                                <br>
                                <button type="button" onclick='uncheckAll()' class="btn btn-primary btn-sm">Clear</button>
                            </li>
                        </ul>
                    </div>
                </div>
    </nav>

<h3 id="catTitle"><?php echo $categoryName; ?></h3><br>
<div class="container-fluid">
    <div class="filter col-md-2 responsive hidden-xs hidden-sm">
        <!-- Main Filter --> 
        <ul class="filterList">
            <li><h4><b>Brand</b></h4></li>
            <?php foreach ($allBrands as $brand): ?>
                <li><label><input data-id="<?php echo $brand['name']; ?>" class="brands" type="checkbox" /> <?php echo $brand['name']; ?></label></li>
            <?php  endforeach ?>
            <li><h4><b>Price</b></h4></li>
            <li><label><input type="checkbox" price-id="0" class="prices"> Under $100</label></li>
            <li><label><input type="checkbox" price-id="100" class="prices"> $100-$200</label></li>
            <li><label><input type="checkbox" price-id="200" class="prices"> $200-$300</label></li>
            <li><label><input type="checkbox" price-id="300" class="prices"> $300-$400</label></li>
            <li><label><input type="checkbox" price-id="400" class="prices"> $400-$500</label></li>
            <li><label><input type="checkbox" price-id="500" class="prices"> More than $500</label></li>
             <li>
                <br>
                <button type="button" onclick='uncheckAll()' class="btn btn-primary btn-sm">Clear</button>
            </li>
        </ul>
    </div>
    
    <!-- Product Grid -->
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
                            <img src="./<?php echo $item['img_src']; ?>" class="img-responsive center-block" style="max-height: 230px;" alt="<?php echo htmlspecialchars($item['name']); ?>" />
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
                                <a href="product.php?id=<?php echo $item['id']; ?>" class="">View Details</a>
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

    <!-- Filter Function (Show/Hide divs)-->
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