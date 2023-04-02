@extends('layout2')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div>
            <!--/breadcrums-->

            <div class="register-req">
                <p>Vui lòng đăng ký hoặc đăng nhập để thanh toán giỏ hàng</p>
            </div>
            <!--/register-req-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="bill-to">
                            <p>Thông tin</p>
                            <div class="form-one">
                                <form action="/save-checkout-customer" method="post">
                                    @csrf
                                    <input type="text" name="shipping_name" required placeholder="Họ Tên*">
                                    <input type="text" name="shipping_email" required placeholder="Email*">
                                    <input type="text" name="shipping_address" required placeholder="Địa chỉ*">
                                    <input type="text" name="shipping_phone" required placeholder="Điện thoại*">
                                    <textarea name="shipping_note" rows="3" placeholder="Ghi chú"></textarea>
                                    <input type="submit" value="Gửi" class="btn btn-sm btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
    </section>
    <!--/#cart_items-->
@endsection
