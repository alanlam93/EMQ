<?php
require 'include/header.php';
if (!isset($_SESSION['userid'])) {
    header('Location: 403.php');
}
?>
                <br />
                <div class="container">
                    <div class="row">
                        <div class="text-center">
                            <div id="account-notification"></div>
                            <!--First one for mobile, second for medium/large -->
                            <button type="button" class="btn btn-success btn-lg btn-block hidden-md hidden-lg" data-toggle="modal" data-target="#passChange">Change Your Password</button>
                            <button type="button" class="btn btn-success btn-lg hidden-xs hidden-sm" data-toggle="modal" data-target="#passChange">Change Your Password</button>

                            <a href="history.php" class="btn btn-success btn-lg btn-block hidden-md hidden-lg" role="button">Order History</a>
                            <a href="history.php" class="btn btn-success btn-lg hidden-xs hidden-sm" role="button">Order History</a>

                            <button type="button" class="btn btn-success btn-lg btn-block hidden-md hidden-lg" data-toggle="modal" data-target="#add-address">Add Address</button>
                            <button type="button" class="btn btn-success btn-lg hidden-xs hidden-sm" data-toggle="modal" data-target="#add-address">Add Address</button>
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
                                    <div id="pass-change-notifications">
                                    </div>
                                    <form id="changePassForm" data-toggle="validator">
                                        <input type="hidden" name="action" value="change_pass" />
                                        <div class="form-group">
                                            <label for="oldPassword" class="control-label">Old Password:</label>
                                            <input type="password" name="old" class="form-control" id="oldPassword" placeholder="Old password" data-error="Please enter your current password." data-required-error="Please enter your current password." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword" class="control-label">New Password:</label>
                                            <input type="password" name="new" class="form-control" id="newPassword" placeholder="New password" data-error="Please enter your new password." data-required-error="Please enter your new password." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword2" class="control-label">Re-enter New Password:</label>
                                            <input type="password" name="new_verify" class="form-control" id="newPassword2" placeholder="Re-enter new password" data-match="#newPassword" data-match-error="Your passwords do not match." data-error="Please re-enter your new password." data-required-error="Please re-enter your new password." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="add-address" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Add New Address</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="add-address-notifications">
                                    </div>
                                    <form id="add-address-form" data-toggle="validator">
                                        <input type="hidden" name="action" value="add_address" />
                                        <div class="form-group">
                                            <label for="address" class="control-label">Full Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" data-error="Please enter the full name." data-required-error="Please enter the full name." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="address" placeholder="Address" data-error="Please enter your address." data-required-error="Please enter your address." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class="control-label">City</label>
                                            <input type="text" name="city" class="form-control" id="city" placeholder="City" data-error="Please enter your city." data-required-error="Please enter your city." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state" class="control-label">State</label>
                                            <select class="form-control" id="state" name="state" data-error="Please select your state." data-required-error="Please select your state." required>
                                                <option value="">Select State</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="CA" selected>California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DC">District of Columbia</option>
                                                <option value="DE">Delaware</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="IA">Iowa</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MD">Maryland</option>
                                                <option value="ME">Maine</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MT">Montana</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NY">New York</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VA">Virginia</option>
                                                <option value="VT">Vermont</option>
                                                <option value="WA">Washington</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="zip" class="control-label">Zip</label>
                                            <input type="text" name="zip" class="form-control" id="zip" pattern="^\d{5}(?:-\d{4})?$" placeholder="Zip Code" data-error="Please enter a valid zip code." data-required-error="Please enter your zip code." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="set-default" class="control-label">Set as Default Address</label>
                                            <select class="form-control" id="set-default" name="set-default" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No" selected>No</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Add Address</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(".modal").on("hidden.bs.modal", function () {
                        $("#pass-change-notifications .close").click();
                    });
                    $('#changePassForm').validator().on('submit', function (e) {
                        if (!e.isDefaultPrevented()) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "include/account-actions.php",
                                data: $('#add-address-form').serialize(),
                                success: function (msg) {
                                    if (msg) {
                                        $("#pass-change-notifications").html(getErrorMessage(msg));
                                    } else {
                                        $('#passChange').modal('hide');
                                        $('#changePassForm')[0].reset();
                                        $("#account-notification").html(getSuccessMessage("Your password was successfully updated."));
                                    }
                                },
                                error: function () {
                                    $("#pass-change-notifications").html(getErrorMessage("An error occured while changing your password."));
                                }
                            });
                        }
                    });
                    $('#add-address-form').validator().on('submit', function (e) {
                        if (!e.isDefaultPrevented()) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "include/account-actions.php",
                                data: $('#add-address-form').serialize(),
                                success: function (msg) {
                                    var retData = JSON.parse(msg);
                                    if (retData.success) {
                                        $('#add-address').modal('hide');
                                        $('#add-address-form')[0].reset();
                                        $("#account-notification").html(getSuccessMessage("Your address was successfully added."));
                                    } else {
                                        $("#add-address-notifications").html(getErrorMessage(retData.message));
                                    }
                                },
                                error: function () {
                                    $("#add-address-notifications").html(getErrorMessage("An error occured while adding your address."));
                                }
                            });
                        }
                    });
                </script>
<?php require 'include/footer.php'; ?>