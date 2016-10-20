<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EMQ Electronics Store</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/catalog.css">
        <link rel="stylesheet" type="text/css" href="css/login-form.css">
        <script>
            $(document).ready(function () {
                $('.modal-toggle').click(function (e) {
                    var tab = e.target.hash;
                    $('li > a[href="' + tab + '"]').tab("show");
                    $(e.target).parent().removeClass('active');
                });

                $('.modal-close').click(function () {
                    $('#login-register-modal').modal('hide');
                });

                $('.modal').on('hidden.bs.modal', function () {
                    $(this).find('form')[0].reset();
                    $(this).find('form')[1].reset();
                });

                $('#register-form').validator().on('submit', function (e) {
                    if (!e.isDefaultPrevented()) {
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "include/register.php",
                            data: $('#register-form').serialize(),
                            success: function (msg) {
                                if (msg) {
                                    $("#register-error").html(msg);
                                } else {
                                    $('#login-register-modal').modal('hide');
                                    $('#register-form')[0].reset();
                                    location.reload(); 
                                }
                            },
                            error: function () {
                                $("#register-error").html("An error occured while registering your account.");
                            }
                        });
                    }
                });
                $('#login-form').validator().on('submit', function (e) {
                    if (!e.isDefaultPrevented()) {
                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "include/login.php",
                            data: $('#register-form').serialize(),
                            success: function (msg) {
                                if (msg) {
                                    $("#register-error").html(msg);
                                } else {
                                    $('#login-register-modal').modal('hide');
                                    $('#register-form')[0].reset();
                                    location.reload(); 
                                }
                            },
                            error: function () {
                                $("#register-error").html("An error occured while registering your account.");
                            }
                        });
                    }
                });
            });
        </script>
        <style>
            footer {
                background-color: #f2f2f2;
                padding: 25px;
            }
        </style>
    </head>
    <body>
        <?php include 'login-form.php' ?>
		<!-- NAVBAR VARIABLES -->
		<?php 
		$home="index.php";
		$logo="./img/logo_noBG2.png";
		$contact = "contact.php";
		$account = "account.php";
		?>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<? $home ?>"><img src="<? $logo ?>" id="logo"/></a>

                </div>
                <!-- IN PROGRESS -->
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<? $home ?>">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Category 1</a></li>
                                <li><a href="#">Category 2</a></li>
                                <li><a href="#">Category 3</a></li>
                                <li class="divider"></li>
                                <li class="nav-header">Divider</li>
                                <li><a href="#">Category 4</a></li>
                                <li><a href="#">Category 5</a></li>
                            </ul>
                        </li>
                        <li><a href="<? $contact ?>">Contact Us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['userid'])) : ?>
                            <li><a>Hello, <?php echo $_SESSION['name'] ?></a></li>
                            <li><a href="<? $account ?>"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                        <?php else : ?>
                            <li><a href="#login" class="modal-toggle" data-toggle="modal" data-target="#login-register-modal">Login</a></li>
                            <li><a href="#register" class="modal-toggle" data-toggle="modal" data-target="#login-register-modal">Register</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li><!--Should not be accessible if not logged in?-->
                        <?php endif; ?>
                    </ul>
                    <!-- Search Bar -->
                    <div class="nav-col nac-col-elastic">
                        <div style="float: right;">
                            <form class="navbar-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter keywords or item #" name="srch-term" id="srch-term">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>