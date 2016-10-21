<?php
require 'include/header.php';
if (!isset($_SESSION['userid'])) {
    header( 'Location: 403.php' ) ;
	//should maybe do a 403 page.
}
?>

<div class="container">
	<div class="row">
		<div class="text-center">
			
			<!--First one for mobile, second for medium/large -->
			<button type="button" class="btn btn-success btn-lg btn-block hidden-md hidden-lg" data-toggle="modal" data-target="#passChange">Change Your Password</button>
			<button type="button" class="btn btn-success btn-lg hidden-xs hidden-sm" data-toggle="modal" data-target="#passChange">Change Your Password</button>

			<button type="button" class="btn btn-success btn-lg btn-block hidden-md hidden-lg" data-toggle="modal" data-target="#orderHistory">Order History</button>
			<button type="button" class="btn btn-success btn-lg hidden-xs hidden-sm" data-toggle="modal" data-target="#orderHistory">Order History</button>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="passChange" role="dialog">
		<div class="modal-dialog">
    
      <!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			<div class="modal-body">
				<form id="changePassForm" method="post" data-toggle="validator">
					<div class="form-group">
						<label for="oldPassword" class="control-label">Old Password:</label>
						<input type="password" class="form-control" id="oldPassword" placeholder="Click to enter your password." data-error="Please enter your password." data-required-error="Please enter your password." required />
                        <div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="newPassword" class="control-label">New Password:</label>
						<input type="password" class="form-control" id="newPassword" placeholder="Click to enter your password." data-error="Please enter your password." data-required-error="Please enter your password." required />
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="newPassword2" class="control-label">Re-enter New Password:</label>
						<input type="password" class="form-control" id="newPassword2" placeholder="Click to enter your password." data-match="#newPassword" data-match-error="Your passwords do not match." data-error="Please re-enter your password." data-required-error="Please re-enter your password." required />
						<div class="help-block with-errors"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
      </div>
      
    </div>
  </div>
	
	
</div>

<?php require 'include/footer.php'; ?>