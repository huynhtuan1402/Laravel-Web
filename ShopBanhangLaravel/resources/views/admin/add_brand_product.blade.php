@extends('admin_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                Vui lòng kiểm tra lại dữ liệu
                            </div>
                        @endif
                        <form role="form" method="post" action="/save-brand-product">
                            @csrf
                            <div class="form-group">
                                <label for="brand_code">Mã thương hiệu</label>
                                <input type="text" class="form-control" id="brand_code" placeholder="Mã thương hiệu"
                                    name="brand_code">
                                    @error('brand_code')
                                        <p style="color: red">Bạn phải nhập mã</p>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="brand_name">Tên thương hiệu</label>
                                <input type="text" class="form-control" id="brand_name" placeholder="Tên thươngh iệu"
                                    name="brand_name">
                                    @error('brand_name')
                                        <p style="color: red">Bạn phải nhập tên</p>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea style="resize: none" type="password" rows="5" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả" name="brand_desc"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="brand_status">
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
