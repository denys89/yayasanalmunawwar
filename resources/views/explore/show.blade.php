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
                    @php
                        // Get all unique categories from the database
                        $categories = App\Models\Explore::select('category')
                            ->where('status', 'published')
                            ->distinct()
                            ->get();
                    @endphp
                    
                    @foreach($categories as $cat)
                        @php
                            // Get the first explore item in this category to use its slug
                            $firstItem = App\Models\Explore::where('category', $cat->category)
                                ->where('status', 'published')
                                ->orderBy('order')
                                ->first();
                            
                            $categoryTitle = $firstItem->title ?? ucfirst(str_replace('_', ' ', $cat->category));
                            
                            // Use the same slug format as in the homepage
                            $urlSlug = $firstItem ? $firstItem->slug : str_replace('_', '-', $cat->category);
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $category == $cat->category ? 'active' : '' }}" 
                               href="{{ route('explore.show', $urlSlug) }}">{{ $categoryTitle }}</a>
                        </li>
                    @endforeach
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
                    <p>Content will be available soon.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
@if($explores->isNotEmpty() && $explores->first()->images->isNotEmpty())
<section class="gallery-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="gallery-one">
                    <div class="swiper-container gallery-one_carousel">
                        <div class="swiper-wrapper">
                            @foreach($explores->first()->images as $image)
                            <div class="swiper-slide">
                                <div class="gallery-one_item">
                                    <div class="gallery-one_image">
                                        @php
                                            $raw = $image->image_url ?? null;
                                            $placeholder = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="600" height="400"><rect width="100%" height="100%" fill="#f3f4f6"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="18">Image unavailable</text></svg>');
                                            $valid = false;
                                            $resolved = null;

                                            if ($raw) {
                                                if (\Illuminate\Support\Str::startsWith($raw, ['http://', 'https://'])) {
                                                    $valid = filter_var($raw, FILTER_VALIDATE_URL) !== false;
                                                    $resolved = $valid ? $raw : null;
                                                } else {
                                                    $valid = \Illuminate\Support\Facades\Storage::disk('public')->exists($raw);
                                                    $resolved = $valid ? asset('storage/' . $raw) : null;
                                                }
                                            }

                                            if (!$valid) {
                                                \Illuminate\Support\Facades\Log::warning('Explore page image invalid or missing', [
                                                    'explore_id' => $explores->first()->id ?? null,
                                                    'image_id' => $image->id ?? null,
                                                    'image_url' => $raw
                                                ]);
                                                $resolved = $placeholder;
                                            }
                                        @endphp
                                        <img src="{{ $resolved }}" alt="{{ $image->caption ?? $explores->first()->title }}" loading="lazy" onerror="console.warn('Image failed to load:', this.src); this.onerror=null; this.src='{{ $placeholder }}';">
                                        <div class="gallery-one_content">
                                            <h3>{{ $image->caption ?? $explores->first()->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-pagination gallery-one_pagination"></div>
                    <div class="gallery-one_nav">
                        <div class="swiper-button-prev gallery-one_prev"><i class="fa fa-angle-left"></i></div>
                        <div class="swiper-button-next gallery-one_next"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Features Section (for Islamic Life) -->
@if($category == 'islamic_life' && $explores->isNotEmpty())
<section class="features-section">
    <div class="container">
        <div class="row">
            @foreach($explores as $item)
            <div class="col-lg-4 col-md-6 feature-block">
                <div class="feature-block-one wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box"><i class="icon flaticon-reading"></i></div>
                        <h4>{{ $item->title }}</h4>
                        <div class="text">{{ Str::limit(strip_tags($item->content), 100) }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection