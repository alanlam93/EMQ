<?php require 'include/header.php'; ?>

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
			<li> <label><input type="checkbox" value="">  Apple</label></li>
			<li> <label><input type="checkbox" value="">  Asus</label></li>
			<li> <label><input type="checkbox" value="">  Logitech</label></li>
			<li> <label><input type="checkbox" value="">  Samsung</label></li>
			<li> <label><input type="checkbox" value="">  Sennheiser</label></li>
			<li><h4>Price</h4></li>
			<li>      
				<div data-role="rangeslider">
		        <label for="price-min">Price:</label>
		        <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
	     		</div>
      		</li>


		</ul>
		
	</div>
	<div class="product_grid col-md-9">
		<div class="row product-row">
			<div class="col-md-3">
				<img src="http://placehold.it/250x150" class="img-responsive" alt="a" />
               	<p> Apple 13.3" Macbook Pro<br> $1,000 <br> Features<br> Add to cart  Details</p>
			</div>
			<div class="col-md-3"><img src="http://placehold.it/250x150" class="img-responsive" alt="a" /></div>
			<div class="col-md-3"><img src="http://placehold.it/250x150" class="img-responsive" alt="a" /></div>
			<div class="col-md-3"><img src="http://placehold.it/250x150" class="img-responsive" alt="a" /></div>
				
		</div>
		
				<div class="row product-row">
			<div class="col-md-3">
				<img src="http://placehold.it/250x150" class="img-responsive" alt="a" />
               	<p> Apple 13.3" Macbook Pro</p>
			</div>
			<div class="col-md-3"><img src="http://placehold.it/250x150" class="img-responsive" alt="a" /></div>
			<div class="col-md-3"><img src="http://placehold.it/250x150" class="img-responsive" alt="a" /></div>
			<div class="col-md-3"><img src="http://placehold.it/250x150" class="img-responsive" alt="a" /></div>
				
		</div>

	</div>
</div>


<?php require 'include/footer.php'; ?>