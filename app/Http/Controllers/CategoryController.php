<?php

namespace App\Http\Controllers;

use App\Models\tbl_brand_product;
use App\Models\tbl_category_product;
use App\Models\tbl_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// class CategoryController extends Controller
// {
//     public function add_category_product()
//     {
//         return view('admin.add_category_product');
//     }
//     public function all_category_product()
//     {
//         $data = [
//             'products' => DB::table('tbl_category_product')->get(),
//         ];
//         return view('admin.all_category_product')->with($data);
//     }
//     public function active_category_product($id)
//     {
//         DB::table('tbl_category_product')->where('id', $id)->update(['category_status' => 1]);
//         return redirect('/all-category-product');
//     }
//     public function unactive_category_product($id)
//     {
//         DB::table('tbl_category_product')->where('id', $id)->update(['category_status' => 0]);
//         return redirect('/all-category-product');
//     }
//     public function save_category_product(Request $request)
//     {
//         // cách 1 
//         // $data=[
//         //     'category_name'=> $request->category_name,
//         //     'category_desc'=>$request->category_desc,
//         //     'category_status'=>$request->category_status
//         // ];
//         // DB::table('tbl_category_product')->insert($data);

//         // cách 2 
//         DB::insert(
//             'insert into tbl_category_product (
//                 category_name, 
//                 category_desc, 
//                 category_status) 
//                 values (?, ?, ?)',
//             [
//                 $request->category_name,
//                 $request->category_desc,
//                 $request->category_status
//             ]
//         );
//         session()->flash('msg', 'Thêm sản phẩm thành công!!');
//         return redirect('/add-category-product');
//     }
//     public function show_detail_category_product($id)
//     {
//         $data = [
//             'product' => DB::table('tbl_category_product')->where('id', $id)->first()
//         ];
//         //DB::update('update users set votes = 100 where name = ?', ['John']);

//         session()->flash('msg', 'Sửa sản phẩm thành công!!');
//         //print_r($data);
//         return view('admin.show-detail-category-product')->with($data);
//     }
//     public function update_category_product(Request $request, $id)
//     {
//         DB::update('update tbl_category_product 
//         set category_name = ?,
//             category_desc = ?
//         where id = ?', [$request->category_name, $request->category_desc, $id]);

//         // $data = [
//         //     'category_name' => $request->category_name,
//         //     'category_desc' => $request->category_desc
//         // ];
//         // DB::table('tbl_category_product')->where('id',$id)->update($data);
//         session()->flash('msg', 'Sửa sản phẩm thành công!!');
//         return redirect('/all-category-product');
//     }
//     public function delete_category_product($id){
//         DB::table('tbl_category_product')->where('id',$id)->delete();
//         return redirect('/all-category-product');
//     }
// }

class CategoryController extends Controller
{
    // thêm
    public function add_category_product()
    {
        return view('admin.add_category_product');
    }

    // hiển thị danh sách
    public function all_category_product()
    {
        $data = [
            'products' => tbl_category_product::get(),
        ];
        return view('admin.all_category_product')->with($data);
    }

    // kích hoạt
    public function active_category_product($id)
    {
       tbl_category_product::where('id', $id)->update(['category_status' => 1]);
        return redirect('/all-category-product');
    }

    // bỏ kích hoạt
    public function unactive_category_product($id)
    {
        tbl_category_product::where('id', $id)->update(['category_status' => 0]);
        return redirect('/all-category-product');
    }

    // lưu thông tin sửa
    public function save_category_product(Request $request)
    {
        $insert_data = $request->post();
        tbl_category_product::create($insert_data);
        session()->flash('msg', 'Thêm sản phẩm thành công!!');
        return redirect('/add-category-product');
    }

    // show thông tin trước khi sửa
    public function show_detail_category_product($id)
    {
        $data = [
            'product' => tbl_category_product::where('id', $id)->first()
        ];
        session()->flash('msg', 'Sửa sản phẩm thành công!!');
        return view('admin.show_detail_category_product')->with($data);
    }

    public function update_category_product(Request $request, $id)
    {
        $data_update = $request->post();
        unset($data_update['_token']);
        tbl_category_product::where('id',$id)->update($data_update);
        session()->flash('msg', 'Sửa sản phẩm thành công!!');
        return redirect('/all-category-product');
    }

    // xóa
    public function delete_category_product($id)
    {
      tbl_category_product::where('id', $id)->delete();
        return redirect('/all-category-product');
    }

    // hiện sản phẩm theo danh mục
    public function show_product_of_category($id){
        $data = [
            'category'=>tbl_category_product::where('category_status',1)->get(),
            'brand'=>tbl_brand_product::where('brand_status',1)->get(),
            'product'=>tbl_product::orderBy('product_code','ASC')->where('category_id',$id)->get()
        ];
        return view('pages.category.show_product_of_category')->with($data);
    }
};
