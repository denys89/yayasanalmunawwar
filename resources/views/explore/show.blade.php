@extends('layouts.app')

@push('scripts')
<script>
    // Gallery images data
    let galleryImages = [];
    let currentImageIndex = 0;

    // Initialize gallery swiper when document is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Populate gallery images array
        @if($explores->isNotEmpty() && $explores->first()->images->isNotEmpty())
        galleryImages = [
            @foreach($explores->first()->images as $image)
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
                    $resolved = $placeholder;
                }
            @endphp
            {
                src: '{{ $resolved }}',
                caption: '{{ $image->caption ?? $explores->first()->title }}',
                alt: '{{ $image->caption ?? $explores->first()->title }}'
            },
            @endforeach
        ];
        @endif

        const carouselEl = document.querySelector('.gallery-one_carousel');
        if (carouselEl && carouselEl.swiper) {
            carouselEl.swiper.destroy(true, true);
        }

        const imgCount = galleryImages.length || document.querySelectorAll('.gallery-one_carousel .swiper-slide').length;
        const spv4 = Math.min(4, imgCount);
        const spv3 = Math.min(3, imgCount);
        const spv2 = Math.min(2, imgCount);

        new Swiper('.gallery-one_carousel', {
            slidesPerView: spv4,
            spaceBetween: 30,
            loop: false,
            autoplay: false,
            navigation: {
                nextEl: '.gallery-one_next',
                prevEl: '.gallery-one_prev',
            },
            pagination: {
                el: '.gallery-one_pagination',
                clickable: true,
            },
            breakpoints: {
                1200: { slidesPerView: spv4 },
                992:  { slidesPerView: spv3 },
                768:  { slidesPerView: spv2 },
                576:  { slidesPerView: spv2 },
                0:    { slidesPerView: 1 }
            }
        });

        // Add hover effects for gallery items
        document.querySelectorAll('.gallery-one_image').forEach(item => {
            const overlay = item.querySelector('.gallery-overlay');
            
            item.addEventListener('mouseenter', function() {
                if (overlay) overlay.style.opacity = '1';
            });
            
            item.addEventListener('mouseleave', function() {
                if (overlay) overlay.style.opacity = '0';
            });
        });

        // Add hover effects for navigation buttons
        document.querySelectorAll('#prevBtn, #nextBtn').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(255,255,255,0.4)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.background = 'rgba(255,255,255,0.2)';
            });
        });

        // Close popup on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImagePopup();
            } else if (e.key === 'ArrowLeft') {
                previousImage();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            }
        });

        // Close popup when clicking outside the image
        document.getElementById('imagePopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImagePopup();
            }
        });
    });

    // Open image popup
    function openImagePopup(index) {
        if (galleryImages.length === 0) return;
        
        currentImageIndex = index;
        const popup = document.getElementById('imagePopup');
        const popupImage = document.getElementById('popupImage');
        const popupCaption = document.getElementById('popupCaption');
        const currentIndexSpan = document.getElementById('currentImageIndex');
        
        // Set image and caption
        popupImage.src = galleryImages[index].src;
        popupImage.alt = galleryImages[index].alt;
        popupCaption.textContent = galleryImages[index].caption;
        currentIndexSpan.textContent = index + 1;
        
        // Show popup
        popup.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Update navigation buttons visibility
        updateNavigationButtons();
    }

    // Close image popup
    function closeImagePopup() {
        const popup = document.getElementById('imagePopup');
        popup.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Navigate to previous image
    function previousImage() {
        if (galleryImages.length === 0) return;
        
        currentImageIndex = currentImageIndex > 0 ? currentImageIndex - 1 : galleryImages.length - 1;
        updatePopupImage();
    }

    // Navigate to next image
    function nextImage() {
        if (galleryImages.length === 0) return;
        
        currentImageIndex = currentImageIndex < galleryImages.length - 1 ? currentImageIndex + 1 : 0;
        updatePopupImage();
    }

    // Update popup image
    function updatePopupImage() {
        const popupImage = document.getElementById('popupImage');
        const popupCaption = document.getElementById('popupCaption');
        const currentIndexSpan = document.getElementById('currentImageIndex');
        
        popupImage.src = galleryImages[currentImageIndex].src;
        popupImage.alt = galleryImages[currentImageIndex].alt;
        popupCaption.textContent = galleryImages[currentImageIndex].caption;
        currentIndexSpan.textContent = currentImageIndex + 1;
        
        updateNavigationButtons();
    }

    // Update navigation buttons visibility
    function updateNavigationButtons() {
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if (galleryImages.length <= 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
        }
    }
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

@section('content')

<!-- Page Title -->
@php
    $bannerImage = null;
    if ($explores->isNotEmpty() && $explores->first()->banner_url) {
        $rawBanner = $explores->first()->banner_url;
        if (\Illuminate\Support\Str::startsWith($rawBanner, ['http://', 'https://'])) {
            $bannerImage = $rawBanner;
        } else {
            $bannerImage = asset('storage/' . $rawBanner);
        }
    } else {
        $bannerImage = asset('images/background/page-title.jpg');
    }
@endphp
<section class="page-title" style="background-image:url({{ $bannerImage }})">
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
<section class="gallery-section" style="padding:0 0 70px 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="gallery-one">
                    <div class="swiper-container gallery-one_carousel">
                        <div class="swiper-wrapper">
                            @foreach($explores->first()->images as $index => $image)
                            <div class="swiper-slide">
                                <div class="gallery-one_item">
                                    <div class="gallery-one_image" style="position: relative; cursor: pointer;" onclick="openImagePopup({{ $index }})">
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
                                        <img src="{{ $resolved }}" alt="{{ $image->caption ?? $explores->first()->title }}" loading="lazy" onerror="console.warn('Image failed to load:', this.src); this.onerror=null; this.src='{{ $placeholder }}';" style="width: 100%; height: 300px; object-fit: cover; border-radius: 8px;">
                                        
                                        <!-- Overlay for zoom icon -->
                                        <div class="gallery-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                            <i class="fas fa-search-plus" style="color: white; font-size: 24px;"></i>
                                        </div>
                                        
                                        <!-- Caption with better styling -->
                                        @if($image->caption)
                                        <div class="gallery-one_content" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.8)); padding: 30px 20px 20px; border-radius: 0 0 8px 8px;">
                                            <h3 style="color: white; font-size: 16px; font-weight: 600; margin: 0; text-shadow: 1px 1px 2px rgba(0,0,0,0.5); line-height: 1.4;">{{ $image->caption }}</h3>
                                        </div>
                                        @endif
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

<!-- Image Popup Modal -->
<div id="imagePopup" class="image-popup-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center;">
    <div class="popup-content" style="position: relative; max-width: 90%; max-height: 90%; display: flex; align-items: center; justify-content: center;">
        <!-- Close button -->
        <button onclick="closeImagePopup()" style="position: absolute; top: -40px; right: 0; background: none; border: none; color: white; font-size: 30px; cursor: pointer; z-index: 10001;">
            <i class="fas fa-times"></i>
        </button>
        
        <!-- Previous button -->
        <button id="prevBtn" onclick="previousImage()" style="position: absolute; left: -60px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; padding: 15px 20px; cursor: pointer; border-radius: 50%; transition: background 0.3s ease;">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <!-- Next button -->
        <button id="nextBtn" onclick="nextImage()" style="position: absolute; right: -60px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); border: none; color: white; font-size: 24px; padding: 15px 20px; cursor: pointer; border-radius: 50%; transition: background 0.3s ease;">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <!-- Image container -->
        <div class="popup-image-container" style="text-align: center;">
            <img id="popupImage" src="" alt="" style="max-width: 100%; max-height: 80vh; object-fit: contain; border-radius: 8px;">
            <div id="popupCaption" style="color: white; margin-top: 20px; font-size: 18px; font-weight: 500; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);"></div>
        </div>
        
        <!-- Image counter -->
        <div class="image-counter" style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); color: white; font-size: 14px;">
            <span id="currentImageIndex">1</span> / <span id="totalImages">{{ count($explores->first()->images) }}</span>
        </div>
    </div>
</div>

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