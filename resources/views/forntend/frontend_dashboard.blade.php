<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>Realshed - HTML 5 Template Preview</title>
    {{-- "{{ asset('Frontend/assets/') }}" --}}
    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('Frontend/assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('Frontend/assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/switcher-style.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/assets/css/responsive.css') }}" rel="stylesheet">

</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">
        <!-- preloader -->
            @include('forntend.home.preload')
        <!-- end preloader -->


        <!-- switcher menu -->

        <!-- end switcher menu -->


        <!-- main header -->
            @include('forntend.home.header')
        <!-- main-header end -->

        <!-- Mobile Menu  -->
            @include('forntend.home.mobile_menu')
        <!-- End Mobile Menu -->

        @yield('main_content')
        

        <!-- main-footer -->
            @include('forntend.home.footer')
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
        <!--Scroll to top end-->
    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('Frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/validation.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/nav-tool.js') }}"></script>

    <!-- main-js -->
    <script src="{{ asset('Frontend/assets/js/script.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >  
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

</body><!-- End of .page_wrapper -->

</html>
