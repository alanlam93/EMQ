<?php include 'login-form.php' ?>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="../img/logo_noBG2.png" id="logo"/></a>

        </div>
        <!-- IN PROGRESS -->
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
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

                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['loggedin_user'])) : ?>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                <?php else : ?>
                    <li><a href="#login" class="modal-toggle" data-toggle="modal" data-target="#login-register-modal">Login</a></li>
                    <li><a href="#register" class="modal-toggle" data-toggle="modal" data-target="#login-register-modal">Register</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
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