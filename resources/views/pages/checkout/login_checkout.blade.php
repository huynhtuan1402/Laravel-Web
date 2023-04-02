@extends('layout2')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v16.0" nonce="mGzOQ41r"></script>
@section('content')

        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Đăng nhập</h2>
                        <form action="login-customer" method="post">
                            {{ csrf_field() }}
                            <input type="text" placeholder="Email" name="email_account" required />
                            <input type="password" placeholder="Password" name="password_account" required />
                            <span>
                                <input type="checkbox" class="checkbox">
                                Ghi nhớ
                            </span>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                        <p>hoặc</p>
                        
                        <a href="https://localhost/auth/facebook"><div class="fb-login-button" data-width="" data-size="" data-button-type="" data-layout="" data-auto-logout-link="false" data-use-continue-as="false"></div>                        <br>
                        {{ session()->has('msg') ? session()->get('msg') : '' }}
                    </div></a>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">HOẶC</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="{{ url('/add-customer') }}" method="post">
                            @csrf
                            <input name="customer_name" type="text" placeholder="Họ tên" />
                            <input name="customer_email" type="email" placeholder="Email Address" />
                            <input name="customer_password" type="password" placeholder="Password" />
                            <input name="customer_phone" type="text" placeholder="Điện thoại" />
                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endsection
