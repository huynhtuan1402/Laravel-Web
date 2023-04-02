<?php

namespace App\Http\Controllers;

use App\Models\tbl_brand_product;
use App\Models\tbl_category_product;
use App\Models\tbl_product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //Start Admin Page
    public function add_product()
    {
        $data = [
            'category' => tbl_category_product::get(),
            'brand' => tbl_brand_product::get()
        ];
        return view('admin.add_product')->with($data);
    }
    public function all_product()
    {
        $data = [
            'products' => DB::table('tbl_product')
                ->leftjoin('tbl_category_product', 'tbl_product.category_code', '=', 'tbl_category_product.category_code')
                ->leftjoin('tbl_brand_product', 'tbl_product.brand_code', '=', 'tbl_brand_product.brand_code')
                ->select('tbl_product.*', 'tbl_brand_product.brand_name', 'tbl_category_product.category_name')
                ->orderby('product_code','asc')->get()
        ];
        return view('admin.all_product')->with($data);
    }
    public function active_product($id)
    {
        tbl_product::where('id', $id)->update(['product_status' => 1]);
        return redirect('/all-product');
    }
    public function unactive_product($id)
    {
        tbl_product::where('id', $id)->update(['product_status' => 0]);
        return redirect('/all-product');
    }
    public function save_product(Request $request)
    {
        $data_insert = $request->post();
        $request->validate([
            'product_code' => 'required|min:3|max:30',
            'product_name' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file_name = time() . $file->GetClientOriginalName();
            $data_insert['product_image'] = $file_name;
            $file->move(public_path('frontend/uploads/product'), $file_name);
        }

        // khi người dùng chọn mã thương hiệu thì lúc insert tự lấy id thương hiệu dựa vào mã
        $brand_id = tbl_brand_product::where('brand_code', $request->brand_code)->select('id')->pluck('id');
        $data_insert['brand_id'] = $brand_id[0];

        $category_id = tbl_category_product::where('category_code', $request->category_code)->select('id')->pluck('id');
        $data_insert['category_id'] = $category_id[0];

        tbl_product::create($data_insert);
        session()->flash('msg', 'Thêm Sản phẩm thành công!!');
        return redirect('/add-product');
    }
    public function show_detailproduct($id)
    {
        $data = [
            'product' => tbl_product::where('id', $id)->first(),
            'brand' => tbl_brand_product::get(),
            'category' => tbl_category_product::get()
        ];
        return view('admin.show_detail_product')->with($data);
        //dd($data['product']);
    }
    public function update_product(Request $request, $id)
    {
        $data_updated = $request->post();
        unset($data_updated['_token']);

        if ($request->hasFile('image')) {
            //$file = $request->image; cách này cũng được
            $file = $request->file('image');
            $file_name = time() . $file->GetClientOriginalName();
            $file->move(public_path('frontend/uploads/product'), $file_name);

            //gán giá trị product_image mới
            $data_updated['product_image'] = $file_name;
        }
        $brand_id = tbl_brand_product::where('brand_code', $request->brand_code)->select('id')->pluck('id');
        $data_updated['brand_id'] = $brand_id[0];

        $category_id = tbl_category_product::where('category_code', $request->category_code)->select('id')->pluck('id');
        $data_updated['category_id'] = $category_id[0];
        $data_updated['updated_at'] = Carbon::now();
        tbl_product::find($id)->update($data_updated);

        session()->flash('msg', 'Sửa thành công!!');
        return redirect('/all-product');
        //return $request->input('product_desc');
    }
    public function delete_product($id)
    {
        DB::table('tbl_product')->where('id', $id)->delete();
        return redirect('/all-product');
    }
    //End Admin Page

    public function product_details($id, $category_code)
    {
        $data = [
            'category' => tbl_category_product::where('category_status', 1)->get(),
            'brand' => tbl_brand_product::where('brand_status', 1)->get(),
            'product' => tbl_product::find($id),
            'related_product' => DB::table('tbl_product')->where('category_code', '=', $category_code)->whereNot('id', $id)->get()
        ];

        return view('pages.product.product_details')->with($data);
    }
    public function admin_search_product(Request $request){
        $product_search = $request->product_search;
        return response()->json([
            'products' => tbl_product::where('product_code','like','%'.$product_search.'%')->get()
        ]);

        dd($product_search);
    }
}
