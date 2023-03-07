<?php

namespace App\Http\Controllers;

use App\Models\tbl_customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class CustomerController extends Controller
{
    public function add_customer(Request $request){
        // $data_insert= $request->post();
        // $data_insert['customer_password']=md5($request->post('customer_password'));
        // tbl_customer::create($data_insert);
        // return redirect('/login-checkout');
    }
}
