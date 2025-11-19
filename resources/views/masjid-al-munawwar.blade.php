@extends('layouts.app')

@section('title', ($program->title ?? $program->name) . ' - Yayasan Al-Munawwar')
@section('description', $program->summary ?? Str::limit(strip_tags($program->description ?? ''), 160))
@section('keywords', ($program->name ?? 'Masjid Al Munawwar') . ', ibadah, dakwah, kajian Islam, sholat, Yayasan Al-Munawwar')

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

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



<div class="green-theme">

<!-- Masjid Al Munawwar Section -->
<section class="welcome-two" style="padding: 120px 0; position: relative;">
    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/icons/pattern-1.png') }});"></div>
    <div class="pattern-layer-two" style="background-image: url({{ asset('assets/images/icons/pattern-2.png') }});"></div>
    
    <div class="auto-container">
        <div class="row clearfix">
            
            <!-- Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ $photoUrl ?? asset('images/resource/welcome-1.jpg') }}" alt="{{ $program->name }}" />
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
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
            <div class="sec-title_title">KEGIATAN & LAYANAN</div>
            <h2 class="sec-title_heading whiteText">Program Ibadah & Dakwah <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text whiteText">Berbagai kegiatan dan layanan yang tersedia di Masjid Al Munawwar untuk memenuhi kebutuhan spiritual dan sosial umat Islam.</div>
        </div>
        
        <div class="row clearfix">
            @forelse(($activities ?? []) as $activity)

            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                        <div class="service-block_one-upper">
                            <div class="service-block_one-icon">
                                @php $icon = $activity->fa_icon ?? 'fa-hand-holding-heart'; @endphp
                                <i class="fas {{ $icon }}"></i>
                            </div>
                            <h4 class="service-block_one-heading"><a href="#">{{ $activity->name }}</a></h4>
                            <div class="service-block_one-text">{!! $activity->description !!}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 centered"><p>Belum ada kegiatan yang ditampilkan.</p></div>
            @endforelse
        </div>
    </div>
</section>

<!-- Schedule Section -->
<section class="institute-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">JADWAL KEGIATAN</div>
            <h2 class="sec-title_heading">Waktu Ibadah & Kegiatan <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Jadwal kegiatan rutin di Masjid Al Munawwar untuk memudahkan jamaah dalam mengikuti berbagai program ibadah dan dakwah.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Institute Block One -->
            <div class="institute-block_one col-lg-6 col-md-12 col-sm-12">
                <div class="institute-block_one-inner">
                    <div class="institute-block_one-icon">
                        <i class="fas fa-praying-hands" style="font-size: 55px; color: #28a745;"></i>
                    </div>
                    <h4 class="institute-block_one-heading">Jadwal Sholat Harian</h4>
                    <div class="institute-block_one-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>
                </div>
            </div>
            
            <!-- Institute Block One -->
            <div class="institute-block_one col-lg-6 col-md-12 col-sm-12">
                <div class="institute-block_one-inner">
                    <div class="institute-block_one-icon"><i class="fas fa-calendar-alt" style="font-size: 55px; color: #28a745;"></i></div>
                    <h4 class="institute-block_one-heading">Kegiatan Mingguan</h4>
                    <div class="institute-block_one-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Donation Section -->
<section class="featured-one" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">CARA BERDONASI</div>
            <h2 class="sec-title_heading">Masjid Al Munawwar</h2>
            <div class="sec-title_text">Berbagai cara mudah untuk berdonasi ke Masjid Al Munawwar.</div>
        </div>
        <div class="row clearfix justify-content-center">
            @forelse(($donations ?? []) as $donation)
                @php $icon = $donation->fa_icon ?? 'fa-hand-holding-heart'; @endphp
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="donation-card wow fadeInUp" data-wow-delay="{{ ($loop->index ?? 0) * 100 }}ms" data-wow-duration="800ms">
                        <div class="donation-card_badge"><i class="fas {{ $icon }}" aria-hidden="true"></i></div>
                        <div class="donation-card_body">
                            <h5 class="donation-card_title">{{ $donation->name }}</h5>
                            <div class="donation-card_text">{!! $donation->description !!}</div>
                            @if(!empty($donation->url))
                                <a href="{{ $donation->url }}" class="theme-btn btn-style-one donation-card_btn"><span class="btn-title">Donasi Sekarang</span></a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 centered"><p>Belum ada informasi donasi.</p></div>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">HUBUNGI KAMI</div>
            <h2 class="sec-title_heading">Informasi Kontak <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang kegiatan, jadwal sholat, atau program dakwah di Masjid Al Munawwar, silakan hubungi kami.</div>
        </div>

        <div class="inner-container mb-5">
            <div class="row clearfix">
                <!-- Info Column -->
                 
                @if($program->address)
                <div class="contact-info_column col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-info_outer">
                        <div class="contact-info_icon fa-solid fa-location-dot fa-fw"></div>
                        <h4 class="contact-info_heading">Alamat Yayasan</h4>
                        <div class="contact-info_text">{{ $program->address }}</div>
                    </div>
                </div>
                @endif

                <!-- Info Column -->
                @if($program->phone)
                <div class="contact-info_column col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-info_outer">
                        <div class="contact-info_icon fa-solid fa-phone fa-fw"></div>
                        <h4 class="contact-info_heading">Nomor Telepon</h4>
                        <div class="contact-info_text">{{ $program->phone }}<span>Let’s Talk <a href="tel:{{ preg_replace('/\s+/', '',$program->phone) }}">{{ $program->phone }}</a></span></div>
                    </div>
                </div>
                @endif

                <!-- Info Column -->
                  @if($program->email)
                <div class="contact-info_column col-lg-4 col-md-6 col-sm-12">
                    <div class="contact-info_outer">
                        <div class="contact-info_icon fa-solid fa-envelope fa-fw"></div>
                        <h4 class="contact-info_heading">Alamat Email</h4>
                        <div class="contact-info_text">
                            <a href="mailto:{{ $program->email }}">{{ $program->email }}</a></div>
                    </div>
                </div>
                @endif

            </div>
            
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
                        <input type="hidden" name="destination" value="masjid">

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