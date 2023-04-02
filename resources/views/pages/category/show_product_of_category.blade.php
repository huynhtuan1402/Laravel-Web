@extends('layout')
@section('content')
    

<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới</h2>
        @foreach ($product as $product)
        <a href="{{url('product-details/'.$product->id.'/'.$product->category_code)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center scale-in-center">
                            <img src="{{asset('frontend/uploads/product/'.$product->product_image)}}" alt="" height="255px" />
                            <h2>{{number_format($product->product_price)}}</h2>
                            <p>{{$product->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                        </div>
                        {{-- <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{$product->product_price}}</h2>
                                <p>{{$product->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                            </div>
                        </div> --}}
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
        @endforeach
    </div><!--features_items-->
    @endsection