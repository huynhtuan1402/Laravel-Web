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
                <p style="text-align: center; font-size:30px">Thanh toán giỏ hàng</p>
            </div>
            <!--/register-req-->

            <div class="review-payment">
                <h2>Kiểm tra giỏ hàng</h2>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Mô tả</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- lấy dữ liệu từ giỏ hàng bằng hàm Cart::content() --}}
                        @php
                            $content = Cart::content();
                            // echo '<pre>';
                            // print_r($content);
                            // echo '</pre>';
                        @endphp

                        @foreach ($content as $v_content)
                            <tr>
                                <td class="cart_product">
                                    <a href=""><img
                                            src="{{ asset('frontend/uploads/product/' . $v_content->options->image) }}"
                                            width="100" height="100"></a>
                                </td>
                                <td class="cart_description">
                                    <a href="">{{ $v_content->name }}</a>
                                    <p>Web ID: {{ $v_content->id }}</p>
                                </td>
                                <td class="cart_price">
                                    <p class="money_fomart">{{ number_format($v_content->price) }}</p>
                                </td>

                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <form method="get" action="/update-cart">

                                            <input class="cart_quantity_input" type="text" name="quantity"
                                                value="{{ $v_content->qty }}" size="2">
                                            <input type="hidden" name="cart_rowId" value="{{ $v_content->rowId }}"
                                                class="form-control">
                                            <input style="height: 28.05px" class="btn btn-default" type="submit"
                                                value="Cập nhật">
                                        </form>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price money_fomart">
                                        {{ number_format($v_content->qty * $v_content->price) . ' đ' }}
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{ url('/delete-cart/' . $v_content->rowId) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="payment-options">
                <h4>Hình thức thanh toán</h4>
                <form action="/order-place" method="post">
                    @csrf
                    {{-- <span>
                        <label><input name="payment_method" value="atm" type="checkbox"> ATM</label>
                    </span>
                    <span>
                        <label><input name="payment_method" value="cash" type="checkbox"> Tiền mặt</label>
                    </span>
                    <span>
                        <label><input name="payment_method" value="creditcard" type="checkbox"> Thẻ ghi nợ</label>
                    </span> --}}
                    <span>
                        <input type="radio" name="payment_method" id="atm" value="atm">
                        <label for="atm">ATM</label>
                    </span>
                    <span>
                        <input type="radio" name="payment_method" id="cash" value="cash">
                        <label for="cash">Tiền mặt</label></span>
                    <span>
                        <input type="radio" name="payment_method" id="creditcard" value="creditcard">
                        <label for="creditcard">Thẻ ghi nợ</label>
                    </span>
                    <br><br>
                    <input class="btn btn-warning" type="submit" value="Đặt hàng">
                </form>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
@endsection
