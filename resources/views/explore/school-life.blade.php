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

<!-- School Life Content Section -->
<section class="school-life-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title mb-4">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="school-life-content">
                    @if($explores->isNotEmpty() && $explores->first()->content)
                        {!! $explores->first()->content !!}
                    @else
                        <p class="mb-4">At Al Munawwar, we believe that education extends beyond the classroom. Our school life is designed to provide a holistic experience that nurtures academic excellence, character development, and personal growth in a supportive and engaging environment.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- School Life Timeline -->
        <div class="timeline-section mt-5">
            <div class="timeline-header">
                <h3>A Day in the Life of an Al Munawwar Student</h3>
            </div>
            <div class="timeline">
                @forelse($explores as $index => $explore)
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h4>{{ $explore->title }}</h4>
                            <p>{{ $explore->excerpt ?? Str::limit(strip_tags($explore->content), 150) }}</p>
                        </div>
                    </div>
                @empty
                    <!-- Fallback timeline items if no explores are available -->
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h4>7:30 AM - Morning Assembly</h4>
                            <p>Students start their day with morning prayers and assembly, setting a positive tone for the day ahead.</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h4>8:00 AM - 12:00 PM - Academic Classes</h4>
                            <p>Students engage in core academic subjects taught by experienced teachers using interactive and innovative teaching methods.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- School Life Image Gallery -->
        @if($explores->isNotEmpty() && $explores->flatMap->images->isNotEmpty())
        <div class="row mt-5">
            <div class="col-12">
                <div class="section-subtitle mb-4">
                    <h3>School Life in Pictures</h3>
                </div>
            </div>
            <!-- Gallery Images -->
            @foreach($explores->flatMap->images->take(6) as $image)
                <div class="col-md-4 mb-4">
                    <div class="gallery-item">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="School Life" class="img-fluid">
                        <div class="gallery-caption">
                            <p>{{ $image->explore->title ?? 'School Life' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
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