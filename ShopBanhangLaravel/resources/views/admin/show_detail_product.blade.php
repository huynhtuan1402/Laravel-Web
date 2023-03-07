@extends('admin_layout')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa thông tin sản phẩm
                </header>
                <?php
                $message = session()->get('msg');
                if ($message) {
                    echo '<h3>' . $message . '</h3>';
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post" action="/update-product/{{ $product->id }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã sản phẩm</label>
                                <input type="text" class="form-control" id="product_code" placeholder="Mã sản phảm"
                                    name="product_code" value="{{ $product->product_code }}">
                            </div>
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Tên sản phảm"
                                    name="product_name" value="{{ $product->product_name }}">
                            </div>
                            <div class="form-group">
                                <label for="category_code">Mã danh mục</label><br>
                                <select name="category_code" id="category_code">
                                    @foreach ($category as $category)
                                        <option {{ $product->category_code == $category->category_code ? 'selected' : '' }}
                                            value="{{ $category->category_code }}">{{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Mã thương hiệu</label><br>
                                <select name="brand_code" id="brand_code">
                                    @foreach ($brand as $brand)
                                        <option {{ $product->brand_code == $brand->brand_code ? 'selected' : '' }}
                                            value="{{ $brand->brand_code }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_desc">Mô tả</label>
                                <textarea style="resize: none" type="password" rows="5" class="form-control ckeditor" id="" placeholder="Mô tả"
                                    name="product_desc">{{ $product->product_desc }} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_content">Content</label>
                                <textarea style="resize: none" type="password" rows="5" class="form-control ckeditor"
                                    placeholder="Mô tả" name="product_content">{{ $product->product_content }} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Giá</label>
                                <input type="text"class="form-control" id="product_price" name="product_price"
                                    value="{{ $product->product_price }}">
                            </div>
                            <div class="form-group">
                                <label for="product_image">Hình ảnh sản phẩm</label>
                                <input type="file" name="image" id="product_image" value="">
                                <img src="{{ asset('frontend/uploads/product/' . $product->product_image) }}"
                                    width="100px" height="100px" alt="hình ảnh sản phẩm">
                                {{-- <input type="file" name="image" id="choose_image"> --}}
                            </div>
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status">
                                    <option {{ $product->product_status == 1 ? 'selected' : '' }} value="1">Hiển thị
                                    </option>
                                    <option {{ $product->product_status == 0 ? 'selected' : '' }} value="0">Ẩn
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="brand_id">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="category_id">
                            </div>
                            <button type="submit" class="btn btn-info">Lưu thông tin sản phẩm</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        // CKEDITOR.replace( 'product_desc' );
    </script>
@endsection
