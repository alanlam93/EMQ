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
                        data: $('#changePassForm').serialize(),
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
        </script>
<?php require 'include/footer.php'; ?>