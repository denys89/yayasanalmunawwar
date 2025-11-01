@extends('layouts.app')

@section('title', ($program->title ?? $program->name) . ' - Yayasan Al-Munawwar')
@section('description', $program->summary ?? Str::limit(strip_tags($program->description ?? ''), 160))
@section('keywords', ($program->name ?? 'Panti Al Munawwar') . ', panti asuhan, yatim piatu, dhuafa, sosial, Yayasan Al-Munawwar')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

@section('content')


<div class="green-theme">

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ $bannerUrl ?? asset('images/background/page-title.jpg') }});">
    <div class="auto-container">
        <h2>{{ $program->name }}</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>{{ $program->name }}</li>
        </ul>
    </div>
</section>

<!-- Panti Al Munawwar Section -->
<section class="welcome-two" style="padding: 120px 0; background-image: url({{ asset('assets/images/background/pattern-1.png') }}); background-repeat: no-repeat; background-position: left center;">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Welcome Two Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ $photoUrl ?? asset('images/resource/welcome-1.jpg') }}" alt="{{ $program->name }}" />
                    </div>
                </div>
            </div>
            
            <!-- Welcome Two Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">{{ strtoupper($program->name) }}</div>
                        <h2 class="sec-title_heading">{{ $program->title ?? $program->name }}</h2>
                        <div class="sec-title_text">{!! $program->summary ?? $program->description !!}</div>
                    </div>
                    
                </div>
            </div>
            
        </div>

    </div>
</section>

<!-- Services Section -->
<section class="service-one" style="background-image: url({{ asset('assets/images/background/service-bg.png') }}); padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">LAYANAN KAMI</div>
            <h2 class="sec-title_heading whiteText">Pelayanan Terpadu <br> untuk Anak Asuh</h2>
            <div class="sec-title_text whiteText">Berbagai layanan komprehensif yang kami berikan untuk memastikan kesejahteraan, pendidikan, dan perkembangan optimal anak-anak asuh.</div>
        </div>
        <div class="row clearfix">
            @forelse(($services ?? []) as $service)
                <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                        <div class="service-block_one-icon">
                            @php $icon = $service->fa_icon ?? 'fa-hand-holding-heart'; @endphp
                            <i class="fas {{ $icon }}" style="font-size: 24px; color: #28a745;"></i>
                        </div>
                        <h5 class="service-block_one-heading"><a href="#">{{ $service->name }}</a></h5>
                        <div class="service-block_one-text">{!! $service->description !!}</div>
                    </div>
                </div>
            @empty
                <div class="col-12 centered"><p>Belum ada layanan yang ditampilkan.</p></div>
            @endforelse
        </div>
    </div>
</section>

<!-- Donation Section -->
<section class="featured-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">CARA BERDONASI</div>
            <h2 class="sec-title_heading">Bergabunglah Membantu <br> Anak Yatim Piatu</h2>
            <div class="sec-title_text">Berbagai cara mudah untuk berdonasi dan membantu anak-anak yatim piatu dan dhuafa melalui Panti Al Munawwar.</div>
        </div>
        <div class="row clearfix">
            @forelse(($donations ?? []) as $donation)
                <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                        <div class="featured-block_one-icon">
                            @php $icon = $donation->fa_icon ?? 'fa-hand-holding-heart'; @endphp
                            <i class="fas {{ $icon }}" style="font-size: 48px; color: #28a745;"></i>
                        </div>
                        <h5 class="featured-block_one-heading">{{ $donation->name }}</h5>
                        <div class="featured-block_one-text">{!! $donation->description !!}</div>
                    </div>
                </div>
            @empty
                <div class="col-12 centered"><p>Belum ada informasi donasi.</p></div>
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-two" style="padding: 80px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">TESTIMONI</div>
            <h2 class="sec-title_heading">Cerita Inspiratif <br> Anak Asuh Al Munawwar</h2>
            <div class="sec-title_text">Dengarkan kisah perjalanan pendidikan dan cita-cita dari anak-anak asuh yang telah merasakan kasih sayang dan pendidikan berkualitas di Panti Al Munawwar.</div>
        </div>
        
        <div class="testimonial-carousel swiper-container" style="margin-top: 50px;">
            <div class="swiper-wrapper">
                
                @forelse($testimonies as $testimony)
                
                <!-- Testimonial Block -->
                <div class="swiper-slide">
                    <div class="testimonial-block_inner" style="background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%); padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; margin: 0 15px; border: 1px solid rgba(44, 90, 160, 0.1); position: relative; overflow: hidden;">
                        @php
                        // Dynamic colors based on testimony ID for variety
                        $colors = [
                            ['color' => '#2c5aa0', 'gradient' => 'linear-gradient(135deg, #2c5aa0, #4a90e2)', 'icon' => 'fas fa-graduation-cap', 'icon_bg' => '#28a745'],
                            ['color' => '#28a745', 'gradient' => 'linear-gradient(135deg, #28a745, #20c997)', 'icon' => 'fas fa-chalkboard-teacher', 'icon_bg' => '#007bff'],
                            ['color' => '#fd7e14', 'gradient' => 'linear-gradient(135deg, #fd7e14, #ff6b35)', 'icon' => 'fas fa-cogs', 'icon_bg' => '#6f42c1'],
                            ['color' => '#6f42c1', 'gradient' => 'linear-gradient(135deg, #6f42c1, #8e44ad)', 'icon' => 'fas fa-microscope', 'icon_bg' => '#17a2b8'],
                            ['color' => '#e74c3c', 'gradient' => 'linear-gradient(135deg, #e74c3c, #c0392b)', 'icon' => 'fas fa-palette', 'icon_bg' => '#f39c12'],
                            ['color' => '#17a2b8', 'gradient' => 'linear-gradient(135deg, #17a2b8, #138496)', 'icon' => 'fas fa-brain', 'icon_bg' => '#e83e8c']
                        ];
                        $colorIndex = $loop->index % count($colors);
                        $currentColor = $colors[$colorIndex];
                        @endphp
                        
                        <!-- Decorative element -->
                        <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: {{ $currentColor['gradient'] }}; border-radius: 50%; opacity: 0.1;"></div>
                        
                        <!-- User Photo -->
                        <div class="testimonial-block_photo" style="text-align: center; margin-bottom: 20px;">
                            <div style="position: relative; display: inline-block;">
                                @if($testimony->photo)
                                    <img src="{{ str_starts_with($testimony->photo, 'http') ? $testimony->photo : asset('storage/' . $testimony->photo) }}" alt="{{ e($testimony->name) }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid {{ $currentColor['color'] }}; box-shadow: 0 5px 15px {{ $currentColor['color'] }}30;" />
                                @else
                                    <div style="width: 80px; height: 80px; border-radius: 50%; background: {{ $currentColor['gradient'] }}; border: 4px solid {{ $currentColor['color'] }}; box-shadow: 0 5px 15px {{ $currentColor['color'] }}30; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user" style="color: white; font-size: 30px;"></i>
                                    </div>
                                @endif
                                <div style="position: absolute; bottom: -5px; right: -5px; width: 25px; height: 25px; background: {{ $currentColor['icon_bg'] }}; border-radius: 50%; border: 3px solid white; display: flex; align-items: center; justify-content: center;">
                                    <i class="{{ $currentColor['icon'] }}" style="color: white; font-size: 10px;"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Student Info -->
                        <div class="testimonial-block_info" style="text-align: center; margin-bottom: 20px;">
                            <h4 style="font-size: 18px; font-weight: 700; color: {{ $currentColor['color'] }}; margin-bottom: 8px;">{{ e($testimony->name) }}</h4>
                            @if($testimony->education)
                                <div style="background: {{ $currentColor['gradient'] }}; color: white; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 600; margin-bottom: 12px; display: inline-block;">{{ e($testimony->education) }}</div>
                            @endif
                            @if($testimony->from)
                                <div style="font-size: 13px; color: #666; margin-bottom: 5px;"><i class="fas fa-map-marker-alt" style="color: {{ $currentColor['color'] }}; margin-right: 5px;"></i>Asal: {{ e($testimony->from) }}</div>
                            @endif
                            @if($testimony->ideal)
                                <div style="font-size: 13px; color: #666; font-weight: 600;"><i class="fas fa-star" style="color: #ffc107; margin-right: 5px;"></i>Cita-cita: {{ e($testimony->ideal) }}</div>
                            @endif
                        </div>
                        
                        <!-- Quote Icon -->
                        <div class="testimonial-block_icon" style="text-align: center; margin-bottom: 15px;">
                            <i class="fas fa-quote-left" style="color: {{ $currentColor['color'] }}; font-size: 28px; opacity: 0.7;"></i>
                        </div>
                        
                        <!-- Testimonial Text -->
                        <div class="testimonial-block_text" style="font-size: 14px; line-height: 1.7; color: #555; text-align: center; font-style: italic; margin-bottom: 20px; position: relative;">
                            "{{ e($testimony->testimony) }}"
                        </div>
                        
                        <!-- Bottom decoration -->
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: {{ $currentColor['gradient'] }};"></div>
                    </div>
                </div>
                
                @empty
                
                <!-- No Testimonials Fallback -->
                <div class="swiper-slide">
                    <div class="testimonial-block_inner" style="background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%); padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); height: 100%; margin: 0 15px; border: 1px solid rgba(44, 90, 160, 0.1); text-align: center;">
                        <div style="color: #666; font-size: 16px; margin-bottom: 20px;">
                            <i class="fas fa-heart" style="color: #2c5aa0; font-size: 48px; margin-bottom: 20px; display: block;"></i>
                            <h4 style="color: #2c5aa0; margin-bottom: 15px;">Testimoni Segera Hadir</h4>
                            <p style="line-height: 1.6;">Kami sedang mengumpulkan cerita inspiratif dari anak-anak asuh Al Munawwar. Testimoni mereka akan segera ditampilkan di sini.</p>
                        </div>
                    </div>
                </div>
                
                @endforelse
                        
            </div>
            
            <!-- Navigation buttons -->
            <div class="swiper-button-next" style="color: #2c5aa0;"></div>
            <div class="swiper-button-prev" style="color: #2c5aa0;"></div>
            
            <!-- Pagination -->
            <div class="swiper-pagination" style="margin-top: 30px;"></div>
        </div>
    </div>
</section>

<!-- Swiper JS Configuration -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        var testimonialSwiper = new Swiper('.testimonial-carousel', {
            slidesPerView: 3,
            spaceBetween: 30,
            slidesPerGroup: 1,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 25,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });
    }
});
</script>

<!-- Contact Section -->
<section class="contact-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">HUBUNGI KAMI</div>
            <h2 class="sec-title_heading">Informasi Kontak <br> Panti Al Munawwar</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang program, donasi, atau kunjungan ke Panti Al Munawwar, silakan hubungi kami melalui kontak di bawah ini.</div>
        </div>
        
        <div class="row clearfix">
            
            @if(!empty($program->phone))
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-phone" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Telepon</h4>
                    <div class="contact-info-block_text">
                        <a href="tel:{{ preg_replace('/\s+/', '', $program->phone) }}">{{ $program->phone }}</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if(!empty($program->email))
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-envelope" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Email</h4>
                    <div class="contact-info-block_text">
                        <a href="mailto:{{ $program->email }}">{{ $program->email }}</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if(!empty($program->address))
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-map-marker-alt" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Alamat</h4>
                    <div class="contact-info-block_text">{!! nl2br(e($program->address)) !!}</div>
                </div>
            </div>
            @endif
            
        </div>

        <!-- Contact Form Box -->
        <div class="contact-form_box">
            <div class="auto-container">
                <h4>Hubungi Kami untuk Konsultasi dan Pendaftaran</h4>

                <!-- Contact Form -->
                <div class="contact-form">
                    @if (session('status'))
                        <div class="alert alert-success" style="padding: 12px; border: 1px solid #d4edda; background-color: #dff0d8; color: #155724; border-radius: 6px; margin-bottom: 16px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" style="padding: 12px; border: 1px solid #f5c6cb; background-color: #f8d7da; color: #721c24; border-radius: 6px; margin-bottom: 16px;">
                            <ul style="margin: 0; padding-left: 18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('hubungi-kami.submit') }}" id="contact-form" accept-charset="UTF-8" autocomplete="on" novalidate>
                        @csrf

                        <!-- Honeypot (anti-spam) -->
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off" style="position:absolute; left:-10000px; opacity:0; height:0; width:0;" aria-hidden="true">

                        <!-- Fixed Destination -->
                        <input type="hidden" name="destination" value="panti">

                        <div class="form-group">
                            <input type="text" name="name" id="name" placeholder="Nama Lengkap" required maxlength="100" value="{{ old('name') }}" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #fff;">
                            @error('name')
                                <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Alamat Email" required maxlength="255" value="{{ old('email') }}" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #fff;">
                            @error('email')
                                <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" id="subject" placeholder="Subjek" required maxlength="255" value="{{ old('subject') }}" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #fff;">
                            @error('subject')
                                <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone_number" id="phone_number" placeholder="Nomor Telepon (opsional)" maxlength="20" value="{{ old('phone_number') }}" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #fff;">
                            @error('phone_number')
                                <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="message" id="message" placeholder="Ketik pesanmu di sini" required maxlength="5000" style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; background-color: #fff; height: 160px;">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback" style="color:#dc3545; font-size: 14px; margin-top: 6px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <!-- Button Box -->
                            <div class="button-box">
                                <button type="submit" class="theme-btn btn-style-four" id="submit-btn">
                                    <span class="btn-wrap">
                                        <span class="text-one">Kirim Pesan</span>
                                        <span class="text-two">Kirim Pesan</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Comment Form -->

            </div>
        </div>
        <!-- End Contact Form Box -->
         
    </div>
</section>
</div>
@endsection