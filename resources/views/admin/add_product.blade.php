@extends('admin_layout')
@section('content')
<script>
    CKEDITOR.replace( 'product_desc' );
</script>  

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" method="post" action="/save-product" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                               <div class="alert alert-danger"> Vui lòng kiểm tra lại dữ liệu</div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã sản phẩm</label>
                                <input type="text" class="form-control" id="product_code" placeholder="Mã sản phảm"
                                    name="product_code">
                                    @error('product_code')
                                        <p style="color: red">Bản phải nhập mã, tối thiểu 3 ký tự, tối đa 20 ký tự</p>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Tên sản phảm"
                                    name="product_name">
                                    @error('product_name')
                                        <p style="color: red">Bản phải nhập tên</p>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_code">Mã danh mục</label><br>
                                <select name="category_code" id="category_code">
                                    @foreach ($category as $category)
                                        <option value="{{$category->category_code}}">{{$category->category_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Mã thương hiệu</label><br>
                                <select name="brand_code" id="brand_code">
                                    @foreach ($brand as $brand)
                                        <option value="{{ $brand->brand_code }}">{{ $brand->brand_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="product_name" placeholder="Tên sản phảm"
                                    name="brand_id">
                            </div>
                            <div class="form-group">
                                <textarea style="resize: none" type="password" rows="5" class="form-control ckeditor" id="product_desc" name="test1" placeholder="Mô tả"
                                    name="product_desc"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_content">Content</label>
                                <textarea style="resize: none" type="password" rows="5" class="form-control ckeditor" id="product_content" name="test2"
                                    placeholder="Mô tả" name="product_content"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Giá</label>
                                <input  type="text"class="form-control" id="product_price"
                                    name="product_price">
                            </div>
                            <div class="form-group">
                                <label for="product_image">Hình ảnh</label>
                                <input type="file" name="image" id="product_image">
                            </div>
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Thêm thương hiệu</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
