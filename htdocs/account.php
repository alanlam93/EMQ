<?php

if (isset($_POST['action'])) {
    include("include/account-actions.php");
}

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['userid'])) {
    header('Location: 403.php');
    return;
}

$account_id = $_SESSION["userid"];

require_once("include/mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while accessing the database.";
    return;
}

$addresses = array();
$accountResult = $mysqli->query("SELECT account.id, email, first_name, last_name, default_addr_id, address.id as address_id, name, address, city, state, zip FROM account INNER JOIN address ON account.id = accountId WHERE account.id = $account_id");
while ($row = $accountResult->fetch_array(MYSQLI_ASSOC)) {
    $addresses[] = $row;
}
$def_addr_id = $addresses[0]['default_addr_id'];
$def_address_index = array_search($def_addr_id, array_column($addresses, 'address_id'));
$def_address = $addresses[$def_address_index];

require 'include/header.php';
?>
                <br />
                <div class="container">
                    <div class="col-sm-10 col-md-8 col-lg-8 col-sm-offset-1 col-md-offset-2 col-lg-offset-2">
                        <div class="text-center">
                            <div id="account-notification"></div>
                        </div>
                        <div class="panel-group">
                            <div class="panel panel-default" style="margin-bottom: 20px;">
                                <div class="panel panel-heading" style="margin-bottom: 0px;">
                                    <strong>Your Account</strong>
                                </div>
                                <div class="panel-body">
                                    <!--First one for mobile, second for medium/large -->
                                    <a href="history.php" class="btn btn-info btn-md btn-block hidden-md hidden-lg" role="button">Order History</a>
                                    <a href="history.php" class="btn btn-info btn-md hidden-xs hidden-sm" role="button">Order History</a>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2"><strong>Name:</strong></div>
                                        <div class="col-md-5"><?php echo $def_address['first_name'] . ' ' . $def_address['last_name'] ?></div>
                                        <div class="col-md-5"><a href="javascript:void(0);" class="btn btn-default btn-sm" role="button" data-toggle="modal" data-target="#name-change" data-record-id="<?php echo $def_address['address_id'] ?>">Edit</a></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2"><strong>Password:</strong></div>
                                        <div class="col-md-10">
                                            <button type="button" class="btn btn-default btn-md btn-block hidden-md hidden-lg" data-toggle="modal" data-target="#passChange">Change Your Password</button>
                                            <button type="button" class="btn btn-default btn-md hidden-xs hidden-sm" data-toggle="modal" data-target="#passChange">Change Your Password</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2"><strong>Email:</strong></div>
                                        <div class="col-md-5"><?php echo $def_address['email'] ?></div>
                                        <div class="col-md-5"><a href="javascript:void(0);" class="btn btn-default btn-sm" role="button" data-toggle="modal" data-target="#email-change" data-record-id="<?php echo $def_address['address_id'] ?>">Change</a></div>
                                    </div>

                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel panel-heading" style="margin-bottom: 0px;">
                                    <strong>Addresses</strong>
                                </div>
                                <div class="panel-body">
                                    <button type="button" class="btn btn-default btn-md btn-block hidden-md hidden-lg" data-toggle="modal" data-target="#add-address">Add Address</button>
                                    <button type="button" class="btn btn-default btn-md hidden-xs hidden-sm" data-toggle="modal" data-target="#add-address">Add Address</button>
                                    <hr>
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-3"><strong>Default Address:</strong></div>
                                        <div class="col-md-9">
                                            <?php echo $def_address['name'] ?>

                                            <br /><?php echo $def_address['address'] ?>

                                            <br /><?php echo $def_address['city'] . ', ' . $def_address['state'] . ' ' . $def_address['zip']; ?>

                                            <br /><a href="javascript:void(0);" class="btn btn-default btn-sm" role="button" data-toggle="modal" data-target="#edit-address" data-record-id="<?php echo $def_address['address_id'] ?>">Edit</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3"><strong>Other Addresses:</strong></div>
                                        <div class="col-md-9"><?php if (sizeof($addresses) < 2) : ?>None<?php else : foreach ($addresses as $address) : if ($address['address_id'] != $def_addr_id) : ?>
                                            
                                            <div class="col-md-6" style="margin-bottom: 10px;padding-left: 0px;padding-right: 0px;">
                                                <?php echo $address['name'] ?><br /><?php echo $address['address'] ?><br /><?php echo $address['city'] . ', ' . $address['state'] . ' ' . $address['zip']; ?>

                                                <br /><a href="javascript:void(0);" class="btn btn-default btn-sm" role="button" data-toggle="modal" data-target="#edit-address" data-record-id="<?php echo $address['address_id'] ?>">Edit</a> <a href="#" class="btn btn-default btn-sm" role="button" data-record-id="<?php echo $address['address_id'] ?>" data-toggle="modal" data-target="#confirm-delete">Remove</a>
                                                <br /><br /><a href="javascript:void(0);" onclick="post('account.php', { 'action' : 'set_def_address', 'addressId': '<?php echo $address['address_id'] ?>'});">Set as Default</a>
                                            </div><?php endif; ?>
                                            <?php endforeach; ?><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="name-change" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Name Change</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="change-name-form" action="account.php" method="post" data-toggle="validator">
                                        <input type="hidden" name="action" value="change_name" />
                                        <div class="form-group">
                                            <label for="first-name" class="control-label">First Name</label>
                                                <input type="text" id="first-name" name="first_name" class="form-control" placeholder="First Name" data-error="Please enter your name." data-required-error="Please enter your name." required />
                                                <div class="help-block with-errors"></div>
                                                <label for="last-name" class="control-label">Last Name</label>
                                                <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Last Name" data-error="Please enter your name." data-required-error="Please enter your name." required />
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
                    <div class="modal fade" id="email-change" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Email Change</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="change-email-form" action="account.php" method="post" data-toggle="validator">
                                        <input type="hidden" name="action" value="change_email" />
                                        <div class="form-group">
                                            <label for="new_email" class="control-label">Email</label>
                                            <input type="email" class="form-control" id="new_email" name="email" placeholder="Email" data-remote="include/register.php" data-error="This email address is invalid or already being used." data-required-error="Please enter your email address." required />
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
                                            <select class="form-control" id="set-default" name="set-default">
                                                <option value="No" selected>No</option>
                                                <option value="Yes">Yes</option>
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
                    <div class="modal fade" id="edit-address" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Update Address</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="edit-address-notifications">
                                    </div>
                                    <form id="edit-address-form" data-toggle="validator">
                                        <input type="hidden" name="action" value="edit_address" />
                                        <input type="hidden" id="edit-address-id" name="addressId" value="" />
                                        <div class="form-group">
                                            <label for="address" class="control-label">Full Name</label>
                                            <input type="text" name="name" class="form-control" id="edit_name" placeholder="Full Name" data-error="Please enter the full name." data-required-error="Please enter the full name." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="edit_address" placeholder="Address" data-error="Please enter your address." data-required-error="Please enter your address." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="city" class="control-label">City</label>
                                            <input type="text" name="city" class="form-control" id="edit_city" placeholder="City" data-error="Please enter your city." data-required-error="Please enter your city." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state" class="control-label">State</label>
                                            <select class="form-control" id="edit_state" name="state" data-error="Please select your state." data-required-error="Please select your state." required>
                                                <option value="">Select State</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="CA">California</option>
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
                                            <input type="text" name="zip" class="form-control" id="edit_zip" pattern="^\d{5}(?:-\d{4})?$" placeholder="Zip Code" data-error="Please enter a valid zip code." data-required-error="Please enter your zip code." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update Address</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this address?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var addresses = <?php echo json_encode($addresses); ?>;
                    $('#edit-address').on('show.bs.modal', function(e) {
                        var data = $(e.relatedTarget).data();
                        var result = $.grep(addresses, function(addr){ return parseInt(addr.address_id, 10) === data.recordId; })[0];
                        $("#edit-address-id").val(result.address_id);
                        $("#edit_name").val(result.name);
                        $("#edit_address").val(result.address);
                        $("#edit_city").val(result.city);
                        $("#edit_state").val(result.state);
                        $("#edit_zip").val(result.zip);
                        $('#edit-address-form').validator('validate');
                    });
                    $('#edit-address-form').validator().on('submit', function (e) {
                        if (!e.isDefaultPrevented()) {
                            e.preventDefault();
                            $('#edit-address').modal('hide');
                            post('account.php', $('#edit-address-form').serializeArray());
                        }
                    });
                    <?php if (isset($account_action_res)) : ?>var retData = <?php echo $account_action_res; ?>;
                    if (retData.success === "true") {
                        $("#account-notification").html(getSuccessMessage(retData.message));
                    } else {
                        $("#account-notification").html(getErrorMessage(retData.message));
                    }
                    <?php endif; ?>$(".modal").on("hidden.bs.modal", function () {
                        $("#pass-change-notifications .close").click();
                    });
                    $('#change-name-form').validator().on('submit', function (e) {
                        if (!e.isDefaultPrevented()) {
                            $('#name-change').modal('hide');
                        }
                    });
                    $('#change-email-form').validator().on('submit', function (e) {
                        if (!e.isDefaultPrevented()) {
                            $('#email-change').modal('hide');
                        }
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
                            $('#add-address').modal('hide');
                            post('account.php', $('#add-address-form').serializeArray());
                        }
                    });
                    $('#confirm-delete').on('click', '.btn-ok', function(e) {
                        var $modalDiv = $(e.delegateTarget);
                        var id = $(this).data('recordId');
                        $modalDiv.modal('hide');
                        post('account.php', { 'action' : 'del_address', 'addressId': id});
                      });
                    $('#confirm-delete').on('show.bs.modal', function(e) {
                        var data = $(e.relatedTarget).data();
                        $('.btn-ok', this).data('recordId', data.recordId);
                    });
                </script>
<?php require 'include/footer.php'; ?>