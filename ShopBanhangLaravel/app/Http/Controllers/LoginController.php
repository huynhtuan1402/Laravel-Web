<?php

namespace App\Http\Controllers;

use App\Models\tbl_social;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirect_to_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        //stateless(): fix lỗi 
        $provider = Socialite::driver('facebook')->stateless()->user();
        $email = $provider->email;
        $username = $provider->name;
        $id = $provider->id;
        $account = tbl_social::where('provider', 'facebook')->where('email', $email)->first();
        if ($account != null) {
            session()->put('customer_id', $account->id);
            return redirect('trang-chu');
        } else {
            $data['provider'] = 'facebook';
            $data['provider_id'] = $id;
            $data['email'] = $email;
            $data['username'] = $username;
            $customer_id = tbl_social::insertGetId($data);
            session()->put('customer_id', $customer_id);
            return redirect('trang-chu');
        }
    }
}
