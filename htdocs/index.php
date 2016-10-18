<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EMQ Electronics Store</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/catalog.css">
        <link rel="stylesheet" type="text/css" href="css/login-form.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.modal-toggle').click(function (e) {
                    var tab = e.target.hash;
                    $('li > a[href="' + tab + '"]').tab("show");
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
        <?php require 'include/navbar.php'; ?>
        <!-- Carousel
   ================================================== -->
        <div id="myCarousel" class="carousel slide">
            <div id="carousel-inner-1" class="carousel-inner">
                <div class="item active">
                    <img src="img/note7_kek.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1></h1>
                            <h2>Now introducing the new Samsung Galaxy Note 7 with <br><font color="red">EXPLOSIVE</font> features!</h2>
                            <a class="btn btn-large btn-primary" href="#">Get It Now</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/blank800x600.png" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p class="lead"></p>
                            <a class="btn btn-large btn-primary" href="#">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/blank800x600.png" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>One more for good measure.</h1>
                            <p class="lead"></p>
                            <a class="btn btn-large btn-primary" href="#">Browse gallery</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev" id="left_carousel">&lsaquo;
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next" id="right_carousel">&rsaquo;
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>
        </div><!-- /.carousel -->

        <!--- PRODUCT CATALOG 
        ======================================= -->
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-md-9">
                        <h3>Best Sellers</h3>
                    </div>
                    <div class="col-md-3">
                        <!-- Controls -->
                        <div class="controls pull-right ">
                            <a class="glyphicon glyphicon-chevron-left btn btn-primary" href="#carousel-example"
                               data-slide="prev"></a><a class="glyphicon glyphicon-chevron-right btn btn-primary" href="#carousel-example"
                               data-slide="next"></a>
                        </div>
                    </div>
                </div>
                <div id="carousel-example" class="carousel slide " data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <a href="#">
                                            <div class="photo">
                                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                            </div>
                                        </a>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>Product #1</h5>
                                                    <h5 class="price-text-color">
                                                        $199.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                    <i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class=""></i>
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <a href="#">
                                            <div class="photo">
                                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                            </div>
                                        </a>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>
                                                        Product #2</h5>
                                                    <h5 class="price-text-color">
                                                        $499.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <a href="">
                                            <div class="photo">
                                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                            </div>
                                        </a>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>Product #3</h5>
                                                    <h5 class="price-text-color">$149.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                    <i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class=""></i>
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <a href="">
                                            <div class="photo">
                                                <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                            </div>
                                        </a>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>
                                                        Product #4</h5>
                                                    <h5 class="price-text-color">
                                                        $1999.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                    <i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class=""></i>
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>

                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>
                                                        Product #5</h5>
                                                    <h5 class="price-text-color">
                                                        $199.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                    <i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class=""></i>
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>
                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>
                                                        Product #6</h5>
                                                    <h5 class="price-text-color">
                                                        $375.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>

                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>
                                                        Product #7</h5>
                                                    <h5 class="price-text-color">
                                                        $149.99</h5>
                                                </div>
                                                <div class="rating  col-md-6">
                                                    <i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class="price-text-color "></i><i class="price-text-color ">
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="separator clear-left">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>

                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-item">
                                        <div class="photo">
                                            <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                                        </div>
                                        <div class="info">
                                            <div class="row">
                                                <div class="price col-md-6">
                                                    <h5>
                                                        Product #8</h5>
                                                    <h5 class="price-text-color">
                                                        $199.99</h5>
                                                </div>
                                                <!-- can add rating through here-->
                                                <div class="rating  col-md-6">
                                                    <i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class="price-text-color "></i><i class="price-text-color ">
                                                    </i><i class=""></i>
                                                </div>
                                            </div>
                                            <div class="separator clear-right">
                                                <p class="btn-add">
                                                    <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                                    <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                                <p class="btn-more">
                                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                                    <a href="#" class="">View More</a>
                                                </p>

                                            </div>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--- END PRODUCT CATALOG  -->
        <br><br><br>
        <footer class="">
            EMQ CORPORATION
        </footer>
    </body>
</html>