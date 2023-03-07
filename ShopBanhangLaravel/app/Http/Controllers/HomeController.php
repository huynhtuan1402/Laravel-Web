<?php

namespace App\Http\Controllers;

use App\Models\tbl_brand_product;
use App\Models\tbl_category_product;
use App\Models\tbl_product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'brand' => tbl_brand_product::orderBy('brand_code', 'asc')->where('brand_status', 1)->get(),
            'product' => tbl_product::where('product_status', 1)->orderBy('id', 'desc')->take(6)->get(),
            //'product' => tbl_product::where('product_status',1)->orderBy('id','desc')->get(),
            'category' => tbl_category_product::orderBy('category_code', 'asc')->where('category_status', 1)->get()
        ];
        return view('pages.home')->with($data);
    }
    public function show_all_product()
    {
        $data = [
            'brand' => tbl_brand_product::orderBy('brand_code', 'asc')->where('brand_status', 1)->get(),
            'product' => tbl_product::where('product_status',1)->orderBy('id','desc')->get(),
            'category' => tbl_category_product::orderBy('category_code', 'asc')->where('category_status', 1)->get()
        ];
        return view('pages.home')->with($data);
    }
    public function customer_search(Request $request)
    {
        $keyword = $request->get('keyword');
        $data = [
            'brand' => tbl_brand_product::orderBy('brand_code', 'asc')->where('brand_status', 1)->get(),
            'product' => tbl_product::where('product_status', 1)
                ->where('product_name', 'like', '%' . $keyword . '%')
                ->orwhere('brand_code', 'like', '%' . $keyword . '%')
                ->orwhere('category_code', 'like', '%' . $keyword . '%')
                ->orderBy('id', 'desc')->get(),
            'category' => tbl_category_product::orderBy('category_code', 'asc')->where('category_status', 1)->get(),
            'keyword' => $keyword
        ];
        return view('pages.product.search')->with($data);
    }
}
