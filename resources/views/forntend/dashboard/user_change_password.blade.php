@extends('forntend.frontend_dashboard')
@section('main_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--Page Title-->
    <section class="page-title centred"
        style="background-image: url({{ asset('Frontend/assets/images/background/page-title-5.jpg') }});">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>User Profile </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>User Profile </li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
    <!-- sidebar-page-container -->
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb"><a href="blog-details.html">
                                            <img class="wd-40 rounded-circle" id="Image"
                                                src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('/upload/no_image.jpg') }}"
                                                alt="User"></a></figure>
                                    <h5><a
                                            href="blog-details.html">{{ $userData->first_name . ' ' . $userData->least_name }}</a>
                                    </h5>
                                    <p>{{ $userData->email }}</p>
                                </div>
                            </div>
                        </div>
                        @include('forntend.dashboard.dsidebar')
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="lower-content">
                                    <h3> Buy or sell</h3>
                                    <ul class="post-info clearfix">
                                        <li class="author-box">
                                            <figure class="author-thumb"><img class="wd-30 rounded-circle" id="Image"
                                                    src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('/upload/no_image.jpg') }}"
                                                    alt="User"></figure>
                                            <h5><a
                                                    href="blog-details.html">{{ $userData->first_name . ' ' . $userData->least_name }}</a>
                                            </h5>
                                        </li>
                                        <li>April 10, 2020</li>
                                    </ul>
                                    <form action="{{ route('user.password.update') }}" method="post" class="default-form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1" class="form-label">User Name</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                autocomplete="off" value="{{ $userData->username }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-label">Old Password</label>
                                            <input type="password"
                                                class="form-control @error('old_password') is-invalid @enderror"
                                                id="old_password" name="old_password">
                                            @error('old_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="new_password" name="new_password">
                                            @error('new_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Confirm Password </label>
                                            <input type="password" class="form-control" id="new_password_confirmation"
                                                name="new_password_confirmation">
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Save Changes </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container -->
    <!-- subscribe-section -->
    <section class="subscribe-section bg-color-3">
        <div class="pattern-layer" style="background-image: url({{ asset('Frontend/assets/images/shape/shape-2.png') }});"></div>
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
