<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function send_mail(){
        $mail_to = session()->get('mail_to'); //email của người nhận
        Mail::to($mail_to)->send(new SendMail($mail_to)); // gửi thông tin sang Mailable
        return view('pages.checkout.payment_success');
    }
}
