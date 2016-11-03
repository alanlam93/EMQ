<?php require 'include/header.php';
$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
echo "An error occured while connecting to the database.";
return;
}
$mysqli->set_charset("utf8");
$result = $mysqli->query("SELECT id, name, price, img_src FROM inventory WHERE is_best_seller = 1");
$allProducts = array();
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
$allProducts[] = $row;
}
$rowCount = 0;
$result->close();
$mysqli->close();
?>
<style>
	#cat_title{
		text-align: center;
	}
	.product_container{
		height: 500px;
	
	margin-top: 5%;
margin-right: 10%;
text-align: center;
	}
	.filter{
		border-right: 1px solid black;
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
</style>
<h3 id="cat_title"> Category 1 </h3>
<div class="product_container">
	<div class="filter col-md-2">
		<ul class="filterList">
			<li><h4>Brand</h4></li>
			<li> <input type="checkbox" value="">  Apple</li>
			<li><input type="checkbox" value="">  Asus</li>
			<li><input type="checkbox" value="">  Logitech</li>
			<li><input type="checkbox" value="">  Samsung</li>
			<li><input type="checkbox" value="">  Sennheiser</li>
			<li><h4>Price</h4></li>
			<li>
				<div class="radio">
					<label><input type="radio" name="priceRadio">Under $100</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="priceRadio">$100-$200</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="priceRadio">$200-$300</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="priceRadio">$300-$400</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="priceRadio">$400-$500</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="priceRadio">More than $500</label>
				</div>
			</li>
			<li>
				<button type="button" class="btn btn-primary btn-md">Filter</button>
			</li>
		</ul>
		
	</div>
	<div class="product_grid col-md-9">
		<div class="row">
			<?php foreach ($allProducts as $item): ?>	
			
			<div class="col-md-3">
				<div class="panel panel-default" style="max-width: 350px; float: left">
					<div class="panel-body panel-image" style="max-height: 250px;">
						<a href="product.php?id=<?php echo $item['id']; ?>">
							<img src="./<?php echo $item['img_src']; ?>" class="img-responsive center-block" style="max-height: 280px" alt="<?php echo htmlspecialchars($item['name']); ?>" />
						</a>
					</div>
					<div class="panel-footer" style="background-color: white; font-size:medium"><a href="product.php?id=<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></a></div>
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
			</div>
			<?php $rowCount++; if (($rowCount%4==0)) echo '<div class="clearfix"></div>' ?>	
			<?php endforeach; ?>
		
		</div>

	</div>
</div>
</div>
</div>
</div>
<?php require 'include/footer.php'; ?>