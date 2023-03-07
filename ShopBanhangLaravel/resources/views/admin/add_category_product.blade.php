@extends('admin_layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
                {{-- {{ session()->has('msg') ? session()->get('msg') : '' }} --}}
                {{-- {{session()->forget('msg');}} --}}
                <?php 
                    $message=session()->get('msg');
                    if($message){
                        echo '<h3>'.$message.'</h3>';
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="post" action="{{url('/save-category-product')}}">
                            @csrf
                            <div class="form-group">
                                <label for="category_code">Mã danh mục</label>
                                <input type="text" class="form-control" id="category_code" placeholder="Mã danh mục" name="category_code">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="category_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả</label>
                                <textarea style="resize: none" type="password" rows="5" class="form-control" id="exampleInputPassword1"
                                    placeholder="Mô tả" name="category_desc"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="category_status">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
