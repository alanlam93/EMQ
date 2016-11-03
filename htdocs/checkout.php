<?php require 'include/header.php'; ?>
<script>
$(document).ready(function() {
    
	$("#step2fields").hide();
	$("#step2summary").hide();
	$("#step3summary").hide();
	$("#step4summary").hide();
    
    // Step 2 //
    $('#activate-step-2').on('click', function(e) {    
		$("#step1fields").hide();
		$("#step1summary").hide();
        $("#step2fields").show();
		$("#step2summary").show();
        $("#pbShip").removeClass('progress-bar-danger');
        $("#pbShip").addClass('progress-bar-custom');
        $("#pbBill").removeClass('progress-bar-custom');
        $("#pbBill").addClass('progress-bar-danger');
    }); 
    // Step 3 //
    $('#activate-step-3').on('click', function(e) {    
		$("#step2fields").hide();
		$("#step2summary").hide();
		$("#step3summary").show();
        $("#pbBill").removeClass('progress-bar-danger');
        $("#pbBill").addClass('progress-bar-custom');
        $("#pbReview").removeClass('progress-bar-custom');
        $("#pbReview").addClass('progress-bar-danger');
    });
	// Step 4 //
    $('#activate-step-4').on('click', function(e) {    
		$("#step3summary").hide();
		$("#step4summary").show();
        $("#pbReview").removeClass('progress-bar-danger');
        $("#pbReview").addClass('progress-bar-custom');
        $("#pbConfirm").removeClass('progress-bar-custom');
        $("#pbConfirm").addClass('progress-bar-danger');
    });  	
});
</script>


<div class="container">
	<div class=" col-lg-6 col-lg-offset-3" style="margin-top: 30px;">
		<div class="progress">
			<div class="progress-bar progress-bar-danger" id="pbShip" role="progressbar" style="width:25%">
				<h4>Shipping</h4>
			</div>
			<div class="progress-bar progress-bar-custom" id="pbBill" role="progressbar" style="width:25%">
				<h4>Billing</h4>
			</div>
			<div class="progress-bar progress-bar-custom" id="pbReview" role="progressbar" style="width:25%">
				<h4>Review</h4>
			</div>
			<div class="progress-bar progress-bar-custom" id="pbConfirm" role="progressbar" style="width:25%">
				<h4>Confirm</h4>
			</div>
		</div>
	</div><!--End Progress Bar-->
	
	<div class="info col-sm-6 col-md-5 col-lg-5 col-sm-offset-1 col-md-offset-2 col-lg-offset-2" style="padding-right: 0px;" id="step1fields">
	<div class="info-container panel panel-default">
		<div class="row">
			<div class="col-md-12"><h3>Shipping Address</h3><br></div>
			<div class="form-group col-md-5">
				<label for="firstName">First Name</label>
				<input type="text" class="form-control" id="firstName">
			</div>
			<div class="form-group col-md-5">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="lastName">
			</div>
			<div class="form-group col-md-10">
				<label for="address">Address</label>
				<input type="text" class="form-control" id="address">
			</div>
			<div class="form-group col-md-10">
				<label for="city">City</label>
				<input type="text" class="form-control" id="city">
			</div>
			<div class="form-group col-md-10">
				<label for="state">State</label>
				<select class="form-control" id="state">
					<option value="AL">Alabama</option>
					<option value="AK">Alaska</option>
					<option value="AZ">Arizona</option>
					<option value="AR">Arkansas</option>
					<option value="CA" selected="selected">California</option>
					<option value="CO">Colorado</option>
					<option value="CT">Connecticut</option>
					<option value="DE">Delaware</option>
					<option value="DC">District Of Columbia</option>
					<option value="FL">Florida</option>
					<option value="GA">Georgia</option>
					<option value="HI">Hawaii</option>
					<option value="ID">Idaho</option>
					<option value="IL">Illinois</option>
					<option value="IN">Indiana</option>
					<option value="IA">Iowa</option>
					<option value="KS">Kansas</option>
					<option value="KY">Kentucky</option>
					<option value="LA">Louisiana</option>
					<option value="ME">Maine</option>
					<option value="MD">Maryland</option>
					<option value="MA">Massachusetts</option>
					<option value="MI">Michigan</option>
					<option value="MN">Minnesota</option>
					<option value="MS">Mississippi</option>
					<option value="MO">Missouri</option>
					<option value="MT">Montana</option>
					<option value="NE">Nebraska</option>
					<option value="NV">Nevada</option>
					<option value="NH">New Hampshire</option>
					<option value="NJ">New Jersey</option>
					<option value="NM">New Mexico</option>
					<option value="NY">New York</option>
					<option value="NC">North Carolina</option>
					<option value="ND">North Dakota</option>
					<option value="OH">Ohio</option>
					<option value="OK">Oklahoma</option>
					<option value="OR">Oregon</option>
					<option value="PA">Pennsylvania</option>
					<option value="RI">Rhode Island</option>
					<option value="SC">South Carolina</option>
					<option value="SD">South Dakota</option>
					<option value="TN">Tennessee</option>
					<option value="TX">Texas</option>
					<option value="UT">Utah</option>
					<option value="VT">Vermont</option>
					<option value="VA">Virginia</option>
					<option value="WA">Washington</option>
					<option value="WV">West Virginia</option>
					<option value="WI">Wisconsin</option>
					<option value="WY">Wyoming</option>
				</select>
			</div>
			
			<div class="form-group col-md-10">
				<label for="zipCode">Zip Code</label>
				<input type="text" class="form-control" id="zipCode">
			</div>
			<div class="col-md-12"><hr><h3>Contact Information</h3><br></div>
			<div class="form-group col-md-10">
				<label for="email">E-Mail</label>
				<input type="text" class="form-control" id="email">
			</div>
			<div class="form-group col-md-10">
				<label for="phoneNum">Phone Number</label>
				<input type="text" class="form-control" id="phoneNum" placeholder="(###)###-####">
			</div>
		</div>
		
	</div>
	</div><!--End Shipping-->
	
	<div class="info col-sm-6 col-md-5 col-lg-5 col-sm-offset-1 col-md-offset-2 col-lg-offset-2" style="padding-right: 0px;" id="step2fields">
		<div class="info-container panel panel-default">
			<div class="row">
				<div class="col-md-12"><h3>Billing Address</h3><br></div>
				<div class="form-group col-md-5">
					<label for="firstName">First Name</label>
					<input type="text" class="form-control" id="firstName">
				</div>
				<div class="form-group col-md-5">
					<label for="lastName">Last Name</label>
					<input type="text" class="form-control" id="lastName">
				</div>
				<div class="form-group col-md-10">
					<label for="address">Address</label>
					<input type="text" class="form-control" id="address">
				</div>
				<div class="form-group col-md-10">
					<label for="city">City</label>
					<input type="text" class="form-control" id="city">
				</div>
				<div class="form-group col-md-10">
					<label for="state">State</label>
					<select class="form-control" id="state">
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA" selected="selected">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				</div>
		
				<div class="form-group col-md-10">
					<label for="zipCode">Zip Code</label>
					<input type="text" class="form-control" id="zipCode">
				</div>
				<div class="col-md-12"><hr><h3>Credit Card Information</h3><br></div>
				<div class="form-group col-md-5">
					<label for="firstName">First Name</label>
					<input type="text" class="form-control" id="firstName">
				</div>
				<div class="form-group col-md-5">
					<label for="lastName">Last Name</label>
					<input type="text" class="form-control" id="lastName">
				</div>
				<div class="form-group col-md-10">
					<label for="creditNum">Credit Card Number</label>
					<input type="text" class="form-control" id="creditNum">
				</div>
				<div class="form-group col-md-3">
					<label for="csv">CSV</label>
					<input type="text" class="form-control" id="csv">
				</div>
				<div class="form-group col-md-3">
					<label for="expiration">Expiration Date</label>
					<input type="text" class="form-control" id="expiration">
				</div>
			</div>
			
		</div>
	</div><!--End Billing-->
	
	<div class="order-summary col-sm-4 col-md-4 col-lg-4" id="step1summary">	
		<div class="panel panel-primary">
			<div class="panel panel-heading">
				<h3>Order Summary</h3>
			</div>
			<div class="panel panel-body">
				<div class="row">
					<div class="col-xs-6 col-md-8 col-lg-8">
						<h4>Item</h4>
					</div>
					<div class="col-xs-3 col-md-2 col-lg-2">
						<h4>Quantity</h4>
					</div>
					<div class="col-xs-3 col-md-2 col-lg-2">
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
					<div class="col-xs-8 col-md-9">
						<h4>Total:</h4>
					</div>
					<div class="col-xs-4 col-md-3">
						<h4>$1234.56</h4>
					</div>
				</div>
				<div class="col-md-3 col-xs-offset-8 col-md-offset-9">
					<a class="btn btn-large btn-primary" id="activate-step-2">Continue</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="order-summary col-sm-4 col-md-4 col-lg-4" id="step2summary">
		<div class="panel panel-primary">
			<div class="panel panel-heading">
				<h3>Order Summary</h3>
			</div>
			<div class="panel panel-body">
				<div class="row">
					<div class="col-xs-6 col-md-8 col-lg-8">
						<h4>Item</h4>
					</div>
					<div class="col-xs-3 col-md-2 col-lg-2">
						<h4>Quantity</h4>
					</div>
					<div class="col-xs-3 col-md-2 col-lg-2">
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
					<div class="col-xs-8 col-md-9">
						<h4>Total:</h4>
					</div>
					<div class="col-xs-4 col-md-3">
						<h4>$1234.56</h4>
					</div>
				</div>
				<div class="col-md-3 col-xs-offset-8 col-md-offset-9">
					<a class="btn btn-large btn-primary" id="activate-step-3">Continue</a>
				</div>
			</div>
		</div>
	</div> <!--End Order Summary 2-->
	
	<div class="order-summary col-sm-6 col-md-8 col-lg-8 col-sm-offset-3 col-md-offset-2 col-lg-offset-2" id="step3summary">
		<div class="panel panel-primary">
			<div class="panel panel-heading">
				<h3>Review Order Details</h3>
			</div>
			<div class="panel panel-body">
				<div class="row">
					<div class="col-xs-6 col-md-8 col-lg-8">
						<h4>Item</h4>
					</div>
					<div class="col-xs-3 col-md-2 col-lg-2">
						<h4>Quantity</h4>
					</div>
					<div class="col-xs-3 col-md-2 col-lg-2">
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
					<div class="col-xs-8 col-md-9">
						<h4>Total:</h4>
					</div>
					<div class="col-xs-4 col-md-3">
						<h4>$1234.56</h4>
					</div>
				</div>
				<div class="col-md-3 col-xs-offset-6 col-md-offset-9">
					<a class="btn btn-large btn-primary" id="activate-step-4">Complete Order</a>
				</div>
			</div>
		</div>
	</div><!--End Review Order-->

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
	</div><!--End Confirm-->

	
</div><!--End Container-->
<?php require 'include/footer.php'; ?>
