<style>
    .card {
        padding: 20px;
        border: 2px solid #ccc;
        background: #f1f1f1;
    }

    /* CSS thẻ bao đoạn text cần ẩn */
    .an {
        display: block;
        display: -webkit-box;
        height: 16px*1.3*3;
        font-size: 16px;
        /* line-height: 1.3; */
        -webkit-line-clamp: 3;
        /* số dòng hiển thị */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        /* margin-top: 10px; */
    }


    th > input {
        width: 100px;
        border-radius: 5%;
        border: 0px;
    }

    .panel-heading > h2 {
        padding-top: 15px;
    }
</style>

@extends('admin_layout')
@section('content')
    <script>
        $(document).ready(function() {
            $('#product_search').keyup(function() {
                var product_search = $('#product_search').val();
                console.log(product_search);
                $.ajax({
                    type: 'GET',
                    url: "{{ url('/admin-search-product') }}",
                    data: {
                        product_search: product_search
                    },
                    success: function(data) {
                        var n = data.products.length;
                        var s = '';
                        for (i = 0; i < n; i++) {
                            s += '<tr>';
                            s += '<td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>';
                            s += '<td><a style="text-decoration:underline" href="/show-detail-product/' + data.products[i].id + '">' + data.products[i].product_code + '</a>';
                            s += '</td>';
                            s += '<td>' + data.products[i].product_name + '</td>';
                            s += '<td>' + data.products[i].category_code + '</td>';
                            s += '<td>' + data.products[i].brand_code + '</td>';
                            s += '<td>' + data.products[i].product_price + '</td>';
                            // s += '<td>' + data.products[i].product_desc + '</td>';
                            // s += '<td>' + data.products[i].product_content + '</td>';
                            s += '<td>' + data.products[i].product_status + '</td>';
                            s += '<td>' + data.products[i].created_at + '</td>';
                            s += '<td>' + data.products[i].updated_at + '</td>';
                            s += '<td><img width="100px" height="120px" alt="hình ảnh sản phẩm"  src="/frontend/uploads/product/'+ data.products[i].product_image + ' "></td>'; 
                            s += '<td>';
                            s += '<a href="/show-detail-product/ '+ data.products[i].id + '" class="active" ui-toggle-class=""> <i class="fa fa-pencil-square-o text-success text-active update"></i></a> ';
                            s+= '<a href="/delete-product/' + data.products[i].id + '" class="active delete" ui-toggle-class=""> <i class="fa fa-times text-danger text"></i> </a> ';                          
                            s+= '</td>';
                            s += '</tr>';
                        }
                        $('#test tbody').html(s);
                    }
                })
            });
        })
    </script>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Danh mục sản phẩm</h2>
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
                <a href="{{ url('/add-product') }}" class="btn btn-sm btn-default">Thêm sản phẩm mới</a>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover b-t b-light" id="test">
                <thead>
                    <tr class="success">
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Mã hàng
                            <br><input type="text" id="product_search" value="">
                        </th>
                        <th>Tên hàng
                            <br><input type="text">
                        </th>
                        <th>Mã nhóm
                            <br><input type="text">
                        </th>
                        <th>Thương hiệu
                            <br><input type="text">
                        </th>
                        <th>Giá <br><input type="text"></th>
                        {{-- <th>Mô tả</th>
                        <th>Ghi chú</th> --}}
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày sửa</th>
                        <th>Hình ảnh</th>
                        <th>Tùy chọn</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <a href=""></a>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><a style="text-decoration:underline"
                                    href="{{ url('show-detail-product/' . $product->id) }}">{{ $product->product_code }}</a>
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->brand_name }}</td>
                            <td>{{ number_format($product->product_price),0,".","," }}</td>
                            {{-- <td>{!! $product->product_desc !!}</td>
                            <td class="an">{!! $product->product_content !!}</td> --}}
                            {{-- <td>{{ $product->product_status }}</td> --}}
                            <td><span class="text-ellipsis">
                                    @if ($product->product_status == 0)
                                        <a href="{{ url('/active-product/' . $product->id) }}"
                                            class="style-thumbs-down fa fa-thumbs-down"></a>
                                    @else
                                        <a href="{{ url('/unactive-product/' . $product->id) }}"
                                            class="style-thumbs-up fa fa-thumbs-up"></a>
                                    @endif
                                </span>
                            </td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>
                                <img src="{{ asset('frontend/uploads/product/' . $product->product_image) }}"
                                    width="100px" height="120px" alt="hình ảnh sản phẩm">
                            </td>
                            <td>
                                <a href="{{ url('/show-detail-product/' . $product->id) }}" class="active"
                                    ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active update"></i>
                                </a>
                                <a href="{{ url('/delete-product/' . $product->id) }}" class="active delete"
                                    ui-toggle-class=""
                                    onclick="return confirm('Bạn có muốn xóa không?? Nhấn OK để xóa/ CANCEL để hủy')">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
            
        </footer>
    </div>
@endsection
