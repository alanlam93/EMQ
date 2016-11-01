<?php
session_start();
require_once("include/mysql-config.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EMQ Electronics Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/catalog.css">
        <link rel="stylesheet" type="text/css" href="css/login-form.css">
        <link rel="stylesheet" href="css/contact.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]-->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>
        <!--[endif]-->
        <script>
            function getErrorMessage(x) {
                return "<div class=\"alert alert-danger fade in\" id=\"notification-box\">" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>" +
                        "<strong>Error!</strong> " + x +
                        "</div>";
            }

            function getSuccessMessage(x) {
                return "<div class=\"alert alert-success fade in\" id=\"notification-box\">" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>" +
                        "<strong>Success!</strong> " + x +
                        "</div>";
            }

            function addToCart(itemId, quantity) {
                $.ajax({
                    type: "GET",
                    url: "include/cart-actions.php?action=add&item-id=" + itemId + "&quantity=" + quantity,
                    success: function (msg) {
                        if (!isNaN(parseFloat(msg)) && isFinite(msg)) {
                            //$(".badge").html(msg);
                            //$("#cart-notifications").html(getSuccessMessage("The item was successfully added to your cart."));
                            window.location.href = "cart.php";
                        } else {
                            $("#cart-notifications").html(getErrorMessage(msg));
                        }
                    },
                    error: function () {
                        $("#cart-notifications").html(getErrorMessage("An error occured while adding to your cart."));
                    }
                });
            }

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
                    $(".close").click();
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
                                    $("#notifications").html(getErrorMessage(msg));
                                } else {
                                    $('#login-register-modal').modal('hide');
                                    $('#register-form')[0].reset();
                                    location.reload();
                                }
                            },
                            error: function () {
                                $("#notifications").html(getErrorMessage("An error occured while registering your account."));
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
                            data: $('#login-form').serialize(),
                            success: function (msg) {
                                if (msg) {
                                    $("#notifications").html(getErrorMessage(msg));
                                } else {
                                    $('#login-register-modal').modal('hide');
                                    $('#login-form')[0].reset();
                                    location.reload();
                                }
                            },
                            error: function () {
                                $("#notifications").html(getErrorMessage("An error occured while logging in."));
                            }
                        });
                    }
                });
            });
        </script>
        <style>
            @media only screen 
            and (min-device-width : 320px) 
            and (max-device-width : 480px) {
                .panel-image {
                    min-height: 0;
                }
            }
            @media only screen 
            and (min-width : 1224px) {
                .panel-image {
                    min-height: 300px;
                }
            }
            .swiper-container {
                width: 80%;
                /*height: 100%;*/
            }
            .swiper-slide {
                padding-bottom: 20px;
                text-align: center;
                font-size: 18px;
                background: #fff;
                /* Center slide text vertically */
                display: -webkit-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                -webkit-align-items: center;
                align-items: center;
            }
            footer {
                background-color: #f2f2f2;
                padding: 25px;
                height: 70px;
            }
        </style>
    </head>
    <body>
        <?php
        include('login-form.php');
        # NAVBAR VARIABLES
        $home = "index.php";
        $logo = "./img/logo_noBG2.png";
        $contact = "contact.php";
        $account = "account.php";

        $mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
        if ($mysqli === null) {
            echo "An error occured while connecting to the database.";
            return;
        }
        $result = $mysqli->query("SELECT id, name FROM category ORDER BY name");
        $categories = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $categories[] = $row;
        }
        $result->close();
        $mysqli->close();
        ?>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= $home ?>"><img src="<?= $logo ?>" id="logo" alt="EMQ" /></a>

                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?= $home ?>">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <?php foreach ($categories as $category): ?>    <li><a href="products.php?cat-id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
                            <?php endforeach; ?></ul>
                        </li>
                        <li><a href="<?= $contact ?>">Contact Us</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset($_SESSION['userid'])) : ?><li><a>Hello, <?php echo $_SESSION['name'] ?></a></li>
                        <li><a href="<?= $account ?>"><span class="glyphicon glyphicon-user"></span> My Account</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <?php else : ?><li><a href="#login" class="modal-toggle" data-toggle="modal" data-target="#login-register-modal">Login</a></li>
                        <li><a href="#register" class="modal-toggle" data-toggle="modal" data-target="#login-register-modal">Register</a></li>
                    <?php endif; ?><li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"><?php $c = isset($_SESSION['cart']) ? array_sum(array_values($_SESSION['cart'])) : 0; if ($c > 0) { echo $c; } ?></span></a></li>
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
