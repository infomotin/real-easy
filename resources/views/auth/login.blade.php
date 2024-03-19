@extends('forntend.frontend_dashboard')
@section('main_content')
    <!--Page Title-->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('Frontend/assets/images/shape/shape-9.png')}};"></div>
            <div class="pattern-2" style="background-image: url({{ asset('Forntend/assets/images/shape/shape-10.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Sign Up</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>Sign Up</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- ragister-section -->
    <section class="ragister-section centred sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                    <div class="sec-title">
                        <h5>Sign up</h5>
                        <h2>Sign In With Realshed</h2>
                    </div>
                    <div class="tabs-box">
                        <div class="tab-btn-box">
                            <ul class="tab-btns tab-buttons centred clearfix">
                                <li class="tab-btn active-btn" data-tab="#tab-1">Login</li>
                                <li class="tab-btn" data-tab="#tab-2">Register</li>
                            </ul>
                        </div>
                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <h4>Login</h4>
                                    <form method="POST" action="{{ route('login') }}" class="default-form">
                                        @csrf
                                        <div class="form-group @error('login') has-error @enderror">
                                            <label>Username/Phone/Email</label>
                                            <input type="text" name="login" id="login" required="">
                                            @error('login')
                                                <span class="help-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('password') has-error @enderror">
                                            <label>Password</label>
                                            <input type="password" name="password" name="password" required="">
                                            @error('password')
                                                <span class="help-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Login</button>
                                        </div>
                                    </form>
                                    <div class="othre-text">
                                        <p>No Account? <a href="{{ route('register') }}">REgister</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab" id="tab-2">
                                <div class="inner-box">
                                    <h4>Register</h4>
                                    <form  method="POST" action="{{ route('register') }}" class="default-form">
                                        @csrf
                                        <div class="form-group @error('name') has-error @enderror">
                                            <label>User name</label>
                                            <input type="text" name="name" id="name" required="">
                                            @error('name')
                                                <span class="help-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('email') has-error @enderror">
                                            <label>Email address</label>
                                            <input type="email" name="email" required="">
                                            @error('email')
                                                <span class="help-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('password') has-error @enderror">
                                            <label>New Password</label>
                                            <input type="password" name="password" id="password" required="">
                                            @error('password')
                                                <span class="help-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group @error('password_confirmation') has-error @enderror">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" required="">
                                            @error('password_confirmation')
                                                <span class="help-block">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Register </button>
                                        </div>
                                    </form>
                                    <div class="othre-text">
                                        <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ragister-section end -->


    <!-- subscribe-section -->
    <section class="subscribe-section bg-color-3">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                    <div class="text">
                        <span>Subscribe</span>
                        <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                    <div class="form-inner">
                        <form action="contact.html" method="post" class="subscribe-form">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter your email" required="">
                                <button type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe-section end -->
@endsection
