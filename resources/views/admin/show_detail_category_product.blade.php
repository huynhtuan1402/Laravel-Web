@extends('admin_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa danh mục sản phẩm
                </header>
                {{-- {{ session()->has('msg') ? session()->get('msg') : '' }} --}}
                {{-- {{session()->forget('msg');}} --}}
                <?php
                $message = session()->get('msg');
                if ($message) {
                    echo '<h3>' . $message . '</h3>';
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post" action="/update-category-product/{{$product->category_id}}">
                            @csrf
                            <div class="form-group">
                                <label for="category_code">Mã danh mục</label>
                                <input type="text" class="form-control" id="category_code" name="category_code"
                                    value="{{ $product->category_code }}">
                            </div>
                            <div class="form-group">
                                <label for="category_name">Tên danh mục</label>
                                <input type="text" class="form-control" id="category_name" name="category_name"
                                    value="{{ $product->category_name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea style="resize: none" type="password" rows="5" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả" name="category_desc">{{ $product->category_desc }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info" onclick="return confirm('Bạn có muốn lưu??')">Lưu</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
