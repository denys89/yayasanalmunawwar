<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Yayasan Al-Munawwar - Lembaga Pendidikan Islam Terpercaya')</title>
    <meta name="description" content="@yield('description', 'Yayasan Al-Munawwar adalah lembaga pendidikan Islam yang berkomitmen memberikan pendidikan berkualitas dengan nilai-nilai Islami.')">
    <meta name="keywords" content="@yield('keywords', 'yayasan al-munawwar, pendidikan islam, sekolah islam, pesantren, pendidikan berkualitas')">
    <meta name="author" content="Yayasan Al-Munawwar">
    
    <!-- Essential Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <!-- Site-wide custom utilities -->
    <link href="{{ asset('style/custom.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    @stack('styles')
</head>

<body>
    <div class="page-wrapper">
        
        <!-- Header -->
        @include('partials.header')
        <!-- End Header -->
        
        <!-- Main Content -->
        @yield('content')
        <!-- End Main Content -->
        
        <!-- Footer -->
        @include('partials.footer')
        <!-- End Footer -->
        
    </div>
    <!-- End PageWrapper -->

    <!-- Essential JavaScript Files Only -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    
    <!-- Minimal custom script -->
    <script>
    // Basic functionality only
    $(document).ready(function() {
        // Mobile menu toggle
        $('.mobile-nav-toggler').on('click', function() {
            $('.mobile-menu').addClass('active');
        });
        
        $('.close-btn').on('click', function() {
            $('.mobile-menu').removeClass('active');
        });
        
        // Smooth scroll
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 1000);
            }
        });
    });
    </script>

    @stack('scripts')
</body>
</html>
