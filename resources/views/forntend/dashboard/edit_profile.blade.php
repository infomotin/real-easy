@extends('forntend.frontend_dashboard')
@section('main_content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--Page Title-->
    <section class="page-title centred" style="background-image: url({{ asset('Frontend/assets/images/background/page-title-5.jpg') }});">
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

                                    <form action="{{ route('user.profile.store') }}" method="post" class="default-form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" id="first_name"
                                                value="{{ $userData->first_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Least Name</label>
                                            <input type="text" name="least_name" id="least_name"
                                                value="{{ $userData->least_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" id="username"
                                                value="{{ $userData->username }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" id="phone"
                                                value="{{ $userData->phone }}" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" id="city"
                                                value="{{ $userData->city }}">
                                        </div>
                                        <div class="form-group">
                                            <label>District</label>
                                            <input type="text" name="district" id="district"
                                                value="{{ $userData->district }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Division</label>
                                            <input type="text" name="division" id="division"
                                                value="{{ $userData->division }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Post Code</label>
                                            <input type="text" name="post_code" id="post_code"
                                                value="{{ $userData->post_code }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="address"
                                                value="{{ $userData->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ $userData->email }}" required="">
                                        </div>

                                        <div class="form-group">
                                            <label for="file" class="form-label">Photo </label>
                                            <input type="file" class="form-control" id="image" name="photo">
                                        </div>

                                        <div class="form-group">
                                            <div class="mb-3">
                                                <label for="file" class="form-label"></label>
                                                <img class="wd-30 rounded-circle" id="showImage"
                                                    src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('/upload/no_image.jpg') }}"
                                                    alt="User" style="width: 100px; height: 100px;"/>
                                            </div>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
