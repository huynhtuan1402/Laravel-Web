@extends('layout2')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
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
                                            <input style="height: 28.05px" class="btn btn-default" type="submit" value="Cập nhật">
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
        </div>
    </section>
    <!--/#cart_items-->

    <section id="do_action">
		<div class="container">
			{{-- <div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> --}}
			<div class="row">
				{{--<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Thành tiền <span>{{Cart::pricetotal(0).' đ'}}</span></li>
							<li>Thuế <span>{{Cart::tax(0).' đ'}}</span></li>
							<li>Phí vận chuyển <span>Free</span></li>
							<li>Tổng cộng <span>{{Cart::total(0).' đ'}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							@if (session()->has('customer_id') && session()->has('shipping_id'))
								<a class="btn btn-default check_out" href="{{url('/payment')}}">Check Out</a>
							@elseif(session()->has('customer_id') && !session()->has('shipping_id'))
								<a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
							@else
								<a class="btn btn-default check_out" href="{{url('/login-checkout')}}">Check Out</a>
							@endif
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection