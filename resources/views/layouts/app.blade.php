<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Yayasan Al-Munawwar - Lembaga Pendidikan Islam Terpercaya')</title>
    <meta name="description" content="@yield('description', 'Yayasan Al-Munawwar adalah lembaga pendidikan Islam yang berkomitmen memberikan pendidikan berkualitas dengan nilai-nilai Islami. Bergabunglah dengan kami untuk masa depan yang lebih baik.')">
    <meta name="keywords" content="@yield('keywords', 'yayasan al-munawwar, pendidikan islam, sekolah islam, pesantren, pendidikan berkualitas, nilai islami')">
    <meta name="author" content="Yayasan Al-Munawwar">
    
    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon_afbd3404a2e1104832d0.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="{{ asset('assets/js/respond.js') }}"></script><![endif]-->

    @stack('styles')
</head>

<body>
    <div class="page-wrapper">
        
        <!-- Cursor -->
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
        <!-- Cursor End -->
        
        <!-- Preloader -->
        <div class="preloader"></div>
        <!-- End Preloader -->
        
        <!-- Header -->
        @include('partials.header')
        <!-- End Header -->
        
        <!-- Main Content -->
        @yield('content')
        <!-- End Main Content -->
        
        <!-- Footer -->
        @include('partials.footer')
        <!-- End Footer -->

        <!-- Search Popup -->
        @include('partials.search-popup')
        <!-- End Search Popup -->
        
    </div>
    <!-- End PageWrapper -->

    <!-- Back to Top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>

    <!-- JavaScript Files -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Initialize Bootstrap components -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Auto-initialize all carousels
            var carouselElements = document.querySelectorAll('.carousel');
            carouselElements.forEach(function(carouselEl) {
                var carousel = new bootstrap.Carousel(carouselEl, {
                    interval: 5000,
                    wrap: true
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/tilt.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.paroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/jarallax.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/backtotop.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.js') }}"></script>
    <script src="{{ asset('assets/js/parallax-scroll.js') }}"></script>

    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/SplitText.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollSmoother.min.js') }}"></script>

    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/nav-tool.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/validate.js') }}"></script>
    <script src="{{ asset('assets/js/element-in-view.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>
