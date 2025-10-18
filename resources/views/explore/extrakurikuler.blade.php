@extends('layouts.app')

@push('scripts')
<script>
    // Initialize gallery swiper when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.gallery-one_carousel', {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.gallery-one_next',
                prevEl: '.gallery-one_prev',
            },
            pagination: {
                el: '.gallery-one_pagination',
                clickable: true,
            },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                },
                992: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 2,
                },
                576: {
                    slidesPerView: 2,
                },
                0: {
                    slidesPerView: 1,
                }
            }
        });
    });
</script>
@endpush


@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('images/background/page-title.jpg') }})">
    <div class="auto-container">
        <h2>{{ $title ?? 'Extracurricular' }}</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>{{ $title ?? 'Extracurricular' }}</li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Tabs Navigation -->
<div class="facilities-tabs-nav bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('explore.fasilitas') ? 'active' : '' }}" href="{{ route('explore.fasilitas') }}">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('explore.extrakurikuler') ? 'active' : '' }}" href="{{ route('explore.extrakurikuler') }}">Extracurricular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('explore.islamic-life') ? 'active' : '' }}" href="{{ route('explore.islamic-life') }}">Islamic Life</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('explore.school-life') ? 'active' : '' }}" href="{{ route('explore.school-life') }}">School Life</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Extracurricular Content Section -->
<section class="extracurricular-section explore-section ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-4">
                    <h2>{{ $title ?? 'Extracurricular Activities' }}</h2>
                </div>
                <div class="extracurricular-content">
                    @if(isset($explores) && $explores->isNotEmpty() && $explores->first()->content)
                        {!! $explores->first()->content !!}
                    @else
                        <p class="mb-4">Our extracurricular program is designed to develop students' talents and interests outside the academic curriculum. We offer a wide range of activities that help students discover their passions, build character, and develop important life skills.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Extracurricular Activities Gallery -->
        <div class="gallery-section mt-4">
            <div class="swiper-container gallery-one_carousel">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/1.jpg" class="img-fluid" alt="Music Room">
                            <div class="gallery-caption">
                                <p>A creative space designed to nurture musical expression through hands-on learning.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/2.jpg" class="img-fluid" alt="Science Lab">
                            <div class="gallery-caption">
                                <p>Well-equipped science labs for hands-on learning, curiosity, and critical thinking.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/3.jpg" class="img-fluid" alt="Dormitory">
                            <div class="gallery-caption">
                                <p>A safe, faith-driven living space that supports students' learning and character growth.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/4.jpg" class="img-fluid" alt="Sports Hall">
                            <div class="gallery-caption">
                                <p>A spacious, multi-purpose facility designed to support students' physical development, teamwork, and sportsmanship.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 5 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/5.jpg" class="img-fluid" alt="Art Studio">
                            <div class="gallery-caption">
                                <p>A vibrant art studio where students explore creativity through various mediums and techniques.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 6 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/6.jpg" class="img-fluid" alt="Computer Lab">
                            <div class="gallery-caption">
                                <p>Modern computer facilities equipped with the latest technology for digital learning.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 7 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/7.jpg" class="img-fluid" alt="Library">
                            <div class="gallery-caption">
                                <p>A comprehensive library with extensive resources to support research and reading.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 8 -->
                    <div class="swiper-slide">
                        <div class="gallery-item">
                            <img src="/assets/images/gallery/8.jpg" class="img-fluid" alt="Outdoor Activities">
                            <div class="gallery-caption">
                                <p>Outdoor learning spaces that encourage exploration and connection with nature.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation buttons -->
                <div class="swiper-button-next gallery-one_next"></div>
                <div class="swiper-button-prev gallery-one_prev"></div>
                
                <!-- Pagination -->
                <div class="swiper-pagination gallery-one_pagination"></div>
            </div>
        </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function(){
        // Initialize the carousel with Bootstrap 5 syntax
        var myCarousel = document.getElementById('extracurricularCarousel');
        if (myCarousel) {
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000,
                wrap: true,
                touch: true
            });
            
            // Handle URL hash to show specific slide
            if (window.location.hash === '#extracurricularCarousel') {
                carousel.cycle();
            }
            
            // Force carousel to be visible and active
            $(myCarousel).css('display', 'block');
        }
        
        // Tab navigation with actual links
        $('.facilities-tabs-nav .nav-link').on('click', function(e) {
            // Don't prevent default as we want to follow the href
        });
    });
</script>
@endpush

<!-- CSS moved to custom.css -->
@endsection