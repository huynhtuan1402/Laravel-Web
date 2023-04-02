{{-- layout dành cho các trang không có phần side bar --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Huỳnh Tuấn</title>
    <link href="{{ asset('frontend/css') }}/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/css') }}/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/css') }}/prettyPhoto.css" rel="stylesheet">
    <link href="{{ asset('frontend/css') }}/price-range.css" rel="stylesheet">
    <link href="{{ asset('frontend/css') }}/animate.css" rel="stylesheet">
    <link href="{{ asset('frontend/css') }}/main.css" rel="stylesheet">
    <link href="{{ asset('frontend/css') }}/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <script src="{{ asset('backend/js/jquery-3.6.3.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('frontend/images') }}/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('frontend/images') }}/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('frontend/images') }}/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('frontend/images') }}/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images') }}/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" type="image/png" href="{{ asset('backend/images') }}/logo.png" />
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> 09999999999</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> huynhquangtuan1402@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://www.facebook.com/huynhtuan1417" target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ url('trang-chu') }}"><img src="{{ asset('frontend/images') }}/logo.png"
                                alt="" width="" height=""/></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-user"></i> Tài khoản</a>
                                </li>
                                <li><a href="{{ url('') }}"><i class="fa fa-star"></i> Yêu thích</a></li>
                                {{-- @if (session()->has('customer_id'))
                                    <li><a href="{{ url('/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh
                                            toán</a></li>
                                @else
                                    <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh
                                            toán</a></li>
                                @endif --}}


                                {{-- start thanh toán --}}
                                <?php
								if (session()->has('customer_id') && session()->has('shipping_id')) { ?>
                                <li><a href="{{ url('/payment') }}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
                                </li>
                                <?php	} elseif (session()->has('customer_id') && !session()->has('shipping_id')) { ?>
                                <li><a href="{{ url('/checkout') }}"><i class="fa fa-crosshairs"> </i>Thanh toán</a>
                                </li>
                                <?php	} else { ?>
                                <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-crosshairs"></i>Thanh
                                        toán</a></li>
                                <?php } ?>
                                {{-- end thanh toán --}}
                                <li><a href="{{ url('/show-cart') }}"><i class="fa fa-shopping-cart"> </i>Giỏ hàng
                                        {{ Cart::count() }} </a>
                                </li>
                                @if (session()->has('customer_id'))
                                    <li><a href="{{ url('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                            xuất</a>
                                    </li>
                                @else
                                    <li><a href="{{ url('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                            nhập</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ url('trang-chu') }}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="{{ url('/show-all-product') }}">Sản phẩm<i
                                            class=""></i></a>
                                </li>
                                <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>

                                </li>
                                <li><a href="{{ url('contact-us') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{ url('/search') }}">
                                <input type="text" placeholder="Search" name="keyword"
                                    value="{{ isset($keyword) ? $keyword : '' }}" />
                                <button type="submit" class="btn btn-danger">Search</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>HUYNH TUAN</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images') }}/iframe1.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images') }}/iframe2.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images') }}/iframe3.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ asset('frontend/images') }}/iframe4.png" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{ asset('frontend/images') }}/map.png" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 HUYNHTUAN Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{ asset('frontend/js') }}/jquery.js"></script>
    <script src="{{ asset('frontend/js') }}/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/js') }}/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('frontend/js') }}/price-range.js"></script>
    <script src="{{ asset('frontend/js') }}/jquery.prettyPhoto.js"></script>
    <script src="{{ asset('frontend/js') }}/main.js"></script>
</body>

</html>
