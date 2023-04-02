<?php

namespace App\Http\Controllers;

use App\Models\tbl_admin;
use App\Models\tbl_order;
use App\Models\tbl_order_details;
use App\Models\tbl_payment;
use App\Models\tbl_shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // muốn truy vấn bằng Query Builder phải use class DB
use Illuminate\Support\Facades\Session;
use stdClass;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->post('admin_email');
        $admin_password = md5($request->post('admin_password'));
        $account = tbl_admin::firstwhere('admin_email', $admin_email);

        if (($account) == null) {
            $request->session()->flash('error1', 'Invalid email');
            return redirect('account/admin');
        }
        if ($account->admin_email == $admin_email && ($account->admin_password) == $admin_password) {
            $admin_name = $account->admin_name;
            Session::put('admin_name', $admin_name);
            Session::put('admin_email', $admin_email);
            return redirect('account/dashboard');
        } else {
            $request->session()->flash('error2', 'Email or password is incorrect!!');
            return redirect('account/admin');
        }
    }
    public function logout(Request $request)
    {
        //$request->session()->flush(); //flush() sẽ xóa tất cả session hiện có.
        $request->session()->forget(['admin_name', 'admin_email']);
        return redirect('/account/admin');
    }
    public function manage_order()
    {
        $data = [
            'orders' => DB::table('tbl_order')
                // ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
                ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
                ->select('tbl_order.*','tbl_shipping.shipping_address', 'tbl_shipping.shipping_phone', 'tbl_shipping.shipping_email','tbl_shipping.shipping_name')
                ->get()
        ];
        return view('admin/manage_order')->with($data);
    }
    public function show_detail_order($order_id)
    {
        //  lấy thông tin đầu phiếu
        $general_info = DB::table('tbl_order')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->select('tbl_customer.*','tbl_shipping.*')->where('tbl_order.id',12)->first();

        // lấy thông tin chi tiết đơn hàng
        $order_details = DB::table('tbl_order')
        ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.id')
        ->select('tbl_order_details.*')->where('tbl_order.id',12)->get();
        
        return view('admin.show-detail-order', compact('general_info','order_details'));

        // $data = [
        //     'order_data' => DB::table('tbl_order')
        //         ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        //         ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        //         ->select('tbl_customer.*')->where('tbl_order.id',$order_id)->first()
        // ];
        // return view('admin.show-detail-order')->with($data);
    }

    public function delete_order($order_id){
        $shipping_id= tbl_order::where('id',$order_id)->pluck('shipping_id');
        $payment_id=tbl_order::where('id',$order_id)->pluck('payment_id');
        tbl_order_details::where('order_id',$order_id)->delete();
        tbl_order::where('id',$order_id)->delete();  
        tbl_shipping::where('shipping_id',$shipping_id)->delete();
        tbl_payment::where('id',$payment_id)->delete();
        return redirect('/manage-order');
    }
}
