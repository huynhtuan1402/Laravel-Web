@extends('layout')
@section('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ asset('frontend/uploads/product/' . $product->product_image) }}" class="newarrival"
                        alt="" width="200" height="500" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                            <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                        </div>

                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information">
                    <!--/product-information-->
                    {{-- <img src="{{asset('frontend/uploads/product/'.$product->product_image)}}" class="newarrival" alt="" width="100" height="200" /> --}}
                    <h2>{{ $product->product_name }}</h2>
                    <p>M??: {{ $product->product_code }}</p>
                    <img src="images/product-details/rating.png" alt="" />
                    <form action="/save-cart" method="POST">
                        @csrf
                        <span>
                            <span name="">{{ number_format($product->product_price) . ' VN??' }}</span>
                            <label>Quantity:</label>
                            <input name="qty" type="number" min="1" value="1" />
                            <input type="hidden" name="productid" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Th??m gi??? h??ng
                            </button>
                        </span>
                    </form>
                    <p><b>T??nh tr???ng:</b> In Stock</p>
                    <p><b>??i???u ki???n:</b> New</p>
                    <p><b>Th????ng hi???u:</b> {{ $product->brand_code }}</p>
                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                            alt="" /></a>
                </div>
                <!--/product-information-->
            </div>
        </div>
        <!--/product-details-->

        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">M?? t???</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Th??ng s??? k??? thu???t</a></li>
                    <li><a href="#reviews" data-toggle="tab">????nh gi??</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <p>{!! $product->product_content !!}</p>
                </div>

                <div class="tab-pane fade" id="companyprofile">
                    <div class="col-sm-3">
                        <p>{!!$product->product_desc!!}</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p><b>Write Your Review</b></p>
                        <p><iframe src="https://www.youtube.com/embed/erMJV51j_00" frameborder="0"></iframe></p>
                        <form action="#">
                            <span>
                                <input type="text" placeholder="Your Name" />
                                <input type="email" placeholder="Email Address" />
                            </span>
                            <textarea name=""></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                G???i
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--/category-tab-->

        <div class="recommended_items">
            <!--recommended_items-->
            <h2 class="title text-center">S???n ph???m g???i ??</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach ($related_product as $related_product)
                            <a
                                href="{{ url('product-details/' . $related_product->id . '/' . $related_product->category_code) }}">
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ asset('frontend/uploads/product/' . $related_product->product_image) }}"
                                                    alt="" height="255px" width="200px"/>
                                                <h2>{{ number_format($related_product->product_price) . ' VND' }}</h2>
                                                <p>{{ $related_product->product_name }}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Th??m gi??? h??ng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    </a>
                </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
        <!--/recommended_items-->
    </div>
    {{-- <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a> --}}
    </div>
    </div>
    <!--/recommended_items-->
    </div>
@endsection
