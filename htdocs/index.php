<?php require 'include/header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.jquery.min.js"></script>
<style>
.swiper-container {
width: 75%;
height: 50%;
}
.swiper-slide {
text-align: center;
font-size: 18px;
background: #fff;
w
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
</style>
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
    <h1 style="margin-left: 10px;">Best Sellers </h1>
    <div class="swiper-container">
        <div class="swiper-wrapper">
                  <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 0</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 1</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 2</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 3</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 4</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 5</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 6</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 7</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 8</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 9</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
        </div> <!-- END SWIPER CONTAINER -->
            <!-- Add Pagination -->
            <div class="swiper-pagination">
                <span class="swiper-pagination-bullet"></span>
                <span class="swiper-pagination-bullet"></span>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next hidden-xs hidden-sm"></div>
            <div class="swiper-button-prev hidden-xs hidden-sm"></div>
    </div>


    <!--- NEWLY ADDED -->

     <h1 style="margin-left: 10px;">Featured </h1>
    <div class="swiper-container">
        <div class="swiper-wrapper">
                  <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 0</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 1</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 2</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 3</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
             <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 4</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 5</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 6</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 7</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 8</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="swiper-slide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="http://placehold.it/350x260" class="img-responsive" alt="a" />
                    </div>
                      <div class=" panel-footer" style="background-color: white;">Product 9</div>
                    <div class="panel-footer hidden-xs hidden-sm" style="background-color: white;">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;">
                            <p class="btn-add">
                                <span class="glyphicon glyphicon-shopping-cart cart-add-logo" ></span>
                                <i class="add-cart"></i><a href="#" class="">Add to cart</a></p>
                                
                            </div>
                            <div class="col-md-6">
                                <p class="btn-more">
                                    <span class="glyphicon glyphicon-th-list more-list"></span>
                                    <a href="#" class="">View More</a>
                                </p>
                            </div>
                        </div>
                    </div>
            </div>
        </div> <!-- END SWIPER CONTAINER -->
            <!-- Add Pagination -->
            <div class="swiper-pagination">
                <span class="swiper-pagination-bullet"></span>
                <span class="swiper-pagination-bullet"></span>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next hidden-xs hidden-sm"></div>
            <div class="swiper-button-prev hidden-xs hidden-sm"></div>
    </div>
        <script>
        var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 3,
        slidesPerGroup: 3,
        paginationClickable: true,
        spaceBetween: 0,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        followFinger: true,
        });
        </script>
        
        
        <!--- END PRODUCT CATALOG  -->
        <?php require 'include/footer.php'; ?>