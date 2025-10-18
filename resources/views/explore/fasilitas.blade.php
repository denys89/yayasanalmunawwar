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
        <h2>{{ $title }}</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>{{ $title }}</li>
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

<!-- Explore Content Section -->
<section class="extracurricular-section explore-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-4">
                    <h2>{{ $title }}</h2>
                </div>
                @if($explores->isNotEmpty() && $explores->first()->content)
                <div class="extracurricular-content">
                    {!! $explores->first()->content !!}
                </div>
                @else
                <div class="extracurricular-content">
                    <p class="mb-4">Explore our facilities and resources designed to enhance the educational experience of our students.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Explore Gallery -->
        <div class="gallery-section mt-4">
            <div class="swiper-container gallery-one_carousel">
                <div class="swiper-wrapper">
                    @forelse($explores as $explore)
                        @if($explore->images->isNotEmpty())
                            @foreach($explore->images as $image)
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid" alt="{{ $explore->title }}">
                                    <div class="gallery-caption">
                                        <p>{{ $explore->title }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <div class="gallery-item">
                                    <img src="{{ asset('assets/images/gallery/' . ($loop->index % 5 + 1) . '.jpg') }}" class="img-fluid" alt="{{ $explore->title }}">
                                    <div class="gallery-caption">
                                        <p>{{ $explore->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <!-- Fallback slides if no explores are available -->
                        <div class="swiper-slide">
                            <div class="gallery-item">
                                <img src="/assets/images/gallery/1.jpg" class="img-fluid" alt="Facility">
                                <div class="gallery-caption">
                                    <p>Our modern facilities support student learning and development.</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
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