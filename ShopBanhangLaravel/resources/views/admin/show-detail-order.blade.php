@extends('admin_layout')
@section('content')
{{-- thông tin người mua --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Thông tin người mua</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$general_info->customer_name}}</td>
                        <td>{{$general_info->customer_phone}}</td>
                        <td>{{$general_info->customer_email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    {{-- thông tin vận chuyển --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Thông tin vận chuyển</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người vận chuyển</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$general_info->shipping_name}}</td>
                        <td>{{$general_info->shipping_phone}}</td>
                        <td>{{$general_info->shipping_address}}</td>
                    </tr>      
                </tbody>
            </table>
        </div>
    </div>
    <br>
    {{-- chi tiết đơn --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Chi tiết đơn hàng</h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_details as $order_detail)
                    <tr>
                        <td>{{$order_detail->product_name}}</td>
                        <td>{{$order_detail->product_price}}</td>
                        <td>{{$order_detail->product_sales_quantity}}</td>
                        <td>{{$order_detail->product_price*$order_detail->product_sales_quantity}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection
