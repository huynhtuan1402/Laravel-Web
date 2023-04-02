<?php

namespace App\Http\Controllers;

use App\Models\tbl_brand_product;
use App\Models\tbl_category_product;
use App\Models\tbl_product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add_brand_product()
    {
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        $data = [
            'brands' => tbl_brand_product::get(),
        ];
        return view('admin.all_brand_product')->with($data);
    }
    public function active_brand_product($id)
    {
        tbl_brand_product::where('id', $id)->update(['brand_status' => 1]);
        return redirect('/all-brand-product');
    }
    public function unactive_brand_product($id)
    {
        tbl_brand_product::where('id', $id)->update(['brand_status' => 0]);
        return redirect('/all-brand-product');
    }
    public function save_brand_product(Request $request)
    {
        $data_insert = $request->post();
        $validated = $request->validate([
            'brand_code' => 'required|min:5',
            'brand_name' => 'required'
        ]);
        tbl_brand_product::create($data_insert);
        session()->flash('msg', 'Thêm thành công!!');
        return redirect('/add-brand-product');
    }
    public function show_detail_brand_product($id)
    {
        $data = [
            'brand' =>  tbl_brand_product::where('id', $id)->first()
        ];
        return view('admin.show_detail_brand_product')->with($data);
    }
    public function update_brand_product(Request $request, $id)
    {
        $data_update = $request->post();
        unset($data_update['_token']);
        tbl_brand_product::where('id', $id)->update($data_update);
        session()->flash('msg', 'Sửa thành công!!');
        return redirect('/all-brand-product');
    }
    public function delete_brand_product($id)
    {
        tbl_brand_product::where('id', $id)->delete();
        return redirect('/all-brand-product');
    }

    // hiện sản phẩm theo brand
    public function show_product_of_brand($id)
    {
        $data = [
            'category' => tbl_category_product::where('category_status', 1)->get(),
            'brand' => tbl_brand_product::where('brand_status', 1)->get(),
            'product' => tbl_product::orderBy('id', 'ASC')->where('brand_id', $id)->get()
        ];
        return view('pages.brand.show_product_of_brand')->with($data);
    }

}
