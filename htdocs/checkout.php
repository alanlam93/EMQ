<?php
require 'include/header.php';
if (!isset($_SESSION['userid']) || !isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
    header('Location: index.php');
    return;
}

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An error occured while logging in.";
    return;
}
$total = 0;
$cart = array();
$mysqli->set_charset("utf8");
$cartQuery = "SELECT id, name, description, price, img_src, SUM(quantity) as quant_rem FROM inventory INNER JOIN inventory_quantity ON inventory.id = inventory_quantity.item_id WHERE id IN (" . implode(", ", array_keys($_SESSION['cart'])) . ") GROUP BY item_id";
$result = $mysqli->query($cartQuery);
$cannot_checkout = false;
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $row['quantity'] = $_SESSION['cart'][$row['id']];
    $total += $row['price'] * $row['quantity'];
    $cart[] = $row;
    if ($row['quantity'] > $row['quant_rem']) {
        $cannot_checkout = true;
    }
}
$total = number_format($total, 2, '.', ',');
$result->close();

if ($cannot_checkout) {
    header('Location: cart.php');
} else {
    $addresses = array();
    $addr_result = $mysqli->query("SELECT default_addr_id, address.id, `name`, address, city, state, zip FROM account INNER JOIN address ON account.id = address.accountId WHERE accountId = '{$_SESSION['userid']}'");
    while ($row = $addr_result->fetch_array(MYSQLI_ASSOC)) {
        $addresses[] = $row;
    }
    $addr_result->close();
}
$mysqli->close();
?>
                <div class="container">
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
                                        <input type="hidden" name="ajax" value="true" />
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
                    <form id="order-form" action="order.php" method="post" data-toggle="validator">
                        <div class="info col-sm-6 col-md-8 col-lg-8 col-sm-offset-3 col-md-offset-2 col-lg-offset-2" style="padding-right: 0px;">
                            <div class="info-container panel panel-default">
                                <div class="row">
                                    <div class="col-md-12"><h3>Shipping Address</h3><br></div>
                                    <div class="form-group col-md-9">
                                        <select class="form-control" name="ship-addr-id" id="address-sel">
                                        <?php foreach ($addresses as $address): ?>    <option value="<?php echo $address['id']; ?>"<?php
                                                if ($address['id'] == $address['default_addr_id']) {
                                                    echo ' selected';
                                                }
                                                ?>><?php echo $address['name'] . ', ' . $address['address'] . ', ' . $address['city'] . ', ' . $address['state'] . ' ' . $address['zip']; ?></option>
                                        <?php endforeach; ?></select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-address">Add Address</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><hr><h3>Billing Address</h3><br></div>
                                    <div class="form-group col-md-9">
                                        <select class="form-control" id="bill-address-sel">
                                            <option value="same" selected>Same as Shipping Address</option>
                                        <?php foreach ($addresses as $address): ?>    <option value="<?php echo $address['id']; ?>"><?php echo $address['name'] . ', ' . $address['address'] . ', ' . $address['city'] . ', ' . $address['state'] . ' ' . $address['zip']; ?></option>
                                        <?php endforeach; ?></select>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="bill-name">Full Name</label>
                                        <input type="text" class="form-control" id="bill-name" placeholder="Full Name" data-error="Please enter the full name." data-required-error="Please enter the full name." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="bill-address">Address</label>
                                        <input type="text" class="form-control" id="bill-address" placeholder="Address" data-error="Please enter your address." data-required-error="Please enter the address." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="bill-city">City</label>
                                        <input type="text" class="form-control" id="bill-city" placeholder="City" data-error="Please enter your city." data-required-error="Please enter the city." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="bill-state">State</label>
                                        <select class="form-control" id="bill-state" data-error="Please select your state." data-required-error="Please select your state.">
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA" selected>California</option>
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
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="bill-zip">Zip Code</label>
                                        <input type="text" class="form-control" id="bill-zip" pattern="^\d{5}(?:-\d{4})?$" placeholder="Zip Code" data-error="Please enter a valid zip code." data-required-error="Please enter the zip code." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-md-12"><hr><h3>Credit Card Information</h3><br></div>
                                    <div class="form-group col-md-10">
                                        <label for="card-name">Name on Card</label>
                                        <input type="text" class="form-control" id="card-name" placeholder="Full Name on Card" data-error="Please enter the full name on the card." data-required-error="Please enter the full name on the card." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label for="card-num">Credit Card Number</label>
                                        <input type="text" class="form-control" id="card-num" name="card-num" pattern="\d{13,16}" placeholder="Credit Card Number (NO SPACES)" data-error="Please enter a valid credit card number." data-required-error="Please enter the credit card number." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="card-csv">CSV/CVV</label>
                                        <input type="text" class="form-control" id="card-csv" pattern="^\d{3}$" placeholder="CSV/CVV" data-error="Please enter a valid CSV/CVV." data-required-error="Please enter the CSV/CVV." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="card-exp-month">Expiration Month</label>
                                        <select class="form-control" id="card-exp-month" size="1">
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="card-exp-year">Year</label>
                                        <input type="text" class="form-control" id="card-exp-year" pattern="^\d{4}$" placeholder="Exp. Year" data-error="Please enter a valid year." data-required-error="Please enter the expiration year." required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-summary col-sm-6 col-md-8 col-lg-8 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
                            <div class="panel panel-primary">
                                <div class="panel panel-heading">
                                    <h3>Review Order Items</h3>
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
                                <?php foreach ($cart as $item): ?>    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-xs-6 col-md-8">
                                            <a href="product.php?id=<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?></a>
                                        </div>
                                        <div class="col-xs-3 col-md-2"><?php echo $item['quantity']; ?></div>
                                        <div class="col-xs-3 col-md-2"><?php echo $item['price']; ?></div>
                                    </div>
                                <?php endforeach; ?>    <hr>
                                    <div class="row">
                                        <div class="col-xs-8 col-md-9">
                                            <h4>Total:</h4>
                                        </div>
                                        <div class="col-xs-4 col-md-3">
                                            <h4>$<?php echo $total; ?></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-offset-6 col-md-offset-9">
                                        <button type="submit" class="btn btn-primary">Complete Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Review Order-->
                    </form>
                </div>
                <!--End Container-->
                <script>
                    var addresses = <?php echo json_encode($addresses); ?>;

                    updateBillingFields("#address-sel");

                    function updateBillingFields(selectId) {
                        var addrSel = $.grep(addresses, function (e) {
                            return e.id === $(selectId + " option:selected").val();
                        })[0];
                        $("#bill-name").val(addrSel.name);
                        $("#bill-address").val(addrSel.address);
                        $("#bill-city").val(addrSel.city);
                        $("#bill-state").val(addrSel.state);
                        $("#bill-zip").val(addrSel.zip);
                    }

                    $('#add-address-form').validator().on('submit', function (e) {
                        if (!e.isDefaultPrevented()) {
                            e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "include/account-actions.php",
                                data: $('#add-address-form').serialize(),
                                success: function (msg) {
                                    var retData = JSON.parse(msg);
                                    if (retData.success === "true") {
                                        $('#add-address').modal('hide');
                                        $('#add-address-form')[0].reset();
                                        $("#account-notification").html(getSuccessMessage("Your address was successfully added."));
                                        $('#address-sel').append($('<option/>', {
                                            value: retData.addr_id,
                                            text: retData.addr_str
                                        }));
                                        $('#bill-address-sel').append($('<option/>', {
                                            value: retData.addr_id,
                                            text: retData.addr_str
                                        }));
                                        $("#address-sel").val(retData.addr_id);
                                        addresses.push(JSON.parse(retData.addr_js));
                                        if ($("#bill-address-sel option:selected").val() === "same") {
                                            updateBillingFields("#address-sel");
                                        }
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

                    $("#address-sel").change(function () {
                        if ($("#bill-address-sel option:selected").val() === "same") {
                            updateBillingFields("#address-sel");
                        }
                    });

                    $("#bill-address-sel").change(function () {
                        if ($("#bill-address-sel option:selected").val() === "same") {
                            updateBillingFields("#address-sel");
                        } else {
                            updateBillingFields("#bill-address-sel");
                        }
                    });
                </script>
<?php require 'include/footer.php'; ?>
