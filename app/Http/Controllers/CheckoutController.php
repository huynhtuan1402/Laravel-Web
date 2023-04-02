<?php

namespace App\Http\Controllers;

use App\Models\tbl_customer;
use App\Models\tbl_order;
use App\Models\tbl_order_details;
use App\Models\tbl_payment;
use App\Models\tbl_shipping;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function login_checkout()
    {
        return view('pages.checkout.login_checkout');
    }

    public function add_customer(Request $request)
    {
        $data_insert = $request->post();
        $data_insert['customer_password'] = md5($request->post('customer_password'));
        // tbl_customer::create($data_insert);

        // lấy id của khách hàng vừa tạo account
        // hàm pluck() lấy ra giá trị 1 thuộc tính nào đó
        //$customer_id = tbl_customer::where('customer_email', $request->customer_email)->orderby('customer_id','desc')->pluck('customer_id')->first();
        unset($data_insert['_token']);
        $data_insert['created_at'] = Carbon::now();
        $customer_id = tbl_customer::insertGetId($data_insert);
        //dd($customer_id);

        session()->put('customer_id', $customer_id);
        session()->put('customer_name', $request->customer_name);
        //session()->forget('customer_id');
        return redirect('/checkout');
    }

    public function save_checkout_customer(Request $request)
    {
        $data = $request->post();

        // nếu không có dòng này sẽ bắt phải thêm _token khi insert dữ liệu vào table
        unset($data['_token']);

        //tbl_shipping::create($request->post());
        // dùng method isertGetId() vừa insert record vừa lấy ra id của record vừa insert. ( column id phải là increament)
        $shipping_id = tbl_shipping::insertGetId($data);

        //dd($shipping_id);
        session()->put('shipping_id', $shipping_id);
        $request->session()->put('shipping_email',$request->shipping_email);
        return redirect('/payment');
    }
    public function checkout()
    {
        //dd(session('customer_id'));
        return view('pages.checkout.show_checkout');
    }

    public function payment()
    {
        //dd(session()->get('shipping_id'));
        return view('pages.checkout.payment');
    }

    public function logout_checkout()
    {
        session()->forget('customer_id');
        session()->forget('shipping_id');
        //session()->flush();
        return redirect('login-checkout');
    }
    public function login_customer(Request $request)
    {
        $email_account = $request->email_account;
        $password = md5($request->password_account);
        $account = tbl_customer::where('customer_email', $email_account)->first();
        //dd($account);
        //dd( $password);
        if ($account == null) {
            session()->flash('msg', 'Email không tồn tại');
            return redirect('login-checkout');
        } else {
            if ($email_account == $account->customer_email && $password == $account->customer_password) {
                session()->put('customer_id', $account->customer_id);
                return redirect('trang-chu');
            } else {
                session()->flash('msg', 'Tên đăng nhập hoặc mật khẩu không đúng');
                return redirect('login-checkout');
            }
        }
    }

    public function order_place(Request $request)
    {
        // insert payment
        $payment = $request->post();
        $payment['payment_status'] = 'Chờ xử lý';
       $payment['created_at'] = Carbon::now();
        //$payment['payment_method'] = $request->post('payment_method');
        unset($payment['_token']); // vì hàm insertGetId() bắt phải có _token nên loại bỏ trước khi insert dữ liệu
        $payment_id = tbl_payment::insertGetId($payment); //sau khi insert lấy ra payment_id

        //  insert order
        // $order = [];
        // unset($order['_token']);
        // $order['customer_id'] = session()->get('customer_id');
        // $order['shipping_id'] = session()->get('shipping_id');
        // $order['payment_id'] = $payment_id;
        // $order['order_total'] = (Cart::total(0));
        // $order['order_status'] = 'Chờ xử lý';
        // $order_id = tbl_order::insertGetId($order);

        // // insert order details
        // // lấy thông tin sản phẩm từ giỏ hàng
        // $products = Cart::content();
        // foreach ($products as $product) {
        //     $order_details['order_id'] = $order_id;
        //     $order_details['product_id'] = $product->id;
        //     $order_details['product_name'] = $product->name;
        //     $order_details['product_price'] = $product->price;
        //     $order_details['product_sales_quantity'] = $product->qty;
        //     tbl_order_details::create($order_details);
        // }
        //dd($payment);
        Cart::destroy(); //sau khi thanh toán xong thì xóa giỏ hàng.

        $mail_to = [ 'mail_to'=> session()->get('shipping_email')];
        return redirect('/payment-success');
        //return redirect('/send-mail')->with($mail_to);
    }
    public function payment_success(){
        return view('pages.checkout.payment-success');
    }
}
