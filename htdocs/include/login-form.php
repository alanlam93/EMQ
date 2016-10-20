<div class="modal fade" id="login-register-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">EMQ</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                            <li><a href="#register" data-toggle="tab">Registration</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="login">
                                <form id="login-form" role="form" class="form-horizontal" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="email1" placeholder="Email" data-error="Please enter your email address." data-required-error="Please enter your email address." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="login-password" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" id="login-password" placeholder="Password" data-error="Please enter your password." data-required-error="Please enter your password." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                        </div>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                            <button type="button" class="btn btn-default btn-sm modal-close">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="register">
                                <form id="register-form" method="post" role="form" class="form-horizontal" data-toggle="validator">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" id="name" name="first_name" class="form-control" placeholder="First Name" data-error="Please enter your name." data-required-error="Please enter your name." required />
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" data-error="Please enter your name." data-required-error="Please enter your name." required />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-delay="1000" data-remote="include/register.php" data-error="This email address is invalid or already being used." data-required-error="Please enter your email address." required />
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" data-error="Please enter your password." data-required-error="Please enter your password." required />
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-reenter" class="col-sm-2 control-label">Re-enter Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" class="form-control" id="password-reenter" placeholder="Re-enter Password" data-match="#password" data-match-error="Your passwords do not match." data-error="Please re-enter your password." data-required-error="Please re-enter your password." required />
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address" class="form-control" id="address" placeholder="Address" data-error="Please enter your address." data-required-error="Please enter your address." required />
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="city" class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="city" class="form-control" id="city" placeholder="City" data-error="Please enter your city." data-required-error="Please enter your city." required />
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="state" class="col-sm-2 control-label">State</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="state" name="state" data-error="Please select your state." data-required-error="Please select your state." required>
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
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip" class="col-sm-2 control-label">Zip</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="zip" class="form-control" id="zip" pattern="^\d{5}(?:-\d{4})?$" placeholder="Zip Code" data-error="Please enter a valid zip code." data-required-error="Please enter your zip code." required />
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="register-error" class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                        </div>
                                        <div class="col-sm-5">
                                            <button type="submit" id="register-submit" class="btn btn-primary btn-sm">Register</button>
                                            <button type="button" class="btn btn-default btn-sm modal-close">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>