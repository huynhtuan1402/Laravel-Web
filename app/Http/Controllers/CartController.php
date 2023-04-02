<?php

namespace App\Http\Controllers;

use App\Models\tbl_brand_product;
use App\Models\tbl_category_product;
use App\Models\tbl_product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        // set giá trị cho các tham số để truyền vào add()
        $productid = $request->productid;
        $quanty = $request->qty;

        // lấy ra sản phẩm được nhấn nút "thêm giỏ hàng"
        $product = tbl_product::where('id', $productid)->first();

        //$cart_data=[];
        // id, name, qty, price, weight, options, image là các tham số bắt buộc cần phải truyền vào method add()
        $cart_data['id'] = $productid;
        $cart_data['name'] = $product->product_name;
        $cart_data['qty'] = $quanty;
        $cart_data['price'] = $product->product_price;
        $cart_data['weight'] = '123';
        $cart_data['options']['image'] = $product->product_image;
        Cart::add($cart_data);
        Cart::setglobaltax(5); // set %vat cho toàn bộ mặt hàng

        //hủy phiên làm việc của cart
        //Cart::destroy();
        return redirect('show-cart');
    }
    public function show_cart()
    {
        $data = [
            'category' => tbl_category_product::get(),
            'brand' => tbl_brand_product::get()
        ];
        return view('pages.cart.cart')->with($data);
    }
    public function delete_cart($rowId)
    {
        // Cart::update($rowId,0);
        Cart::remove($rowId);
        return redirect('/show-cart');
    }
    public function update_cart(Request $request)
    {
        $qty = $request->quantity;
        $rowId = $request->cart_rowId;
        Cart::update($rowId, $qty);
        return redirect('show-cart');
    }
}
