@extends('layouts.app')

@section('title', ($program->title ?? $program->name) . ' - Yayasan Al-Munawwar')
@section('description', $program->summary ?? Str::limit(strip_tags($program->description ?? ''), 160))
@section('keywords', $program->name . ', program sosial, layanan, donasi, Yayasan Al-Munawwar')

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
            <h2 class="sec-title_heading">Pelayanan Terpadu <br> untuk Anak Asuh</h2>
            <div class="sec-title_text">{!! $program->description ?? 'Berbagai layanan komprehensif yang kami berikan untuk memastikan kesejahteraan, pendidikan, dan perkembangan optimal anak-anak asuh.' !!}</div>
        </div>
        <div class="row clearfix">

            @forelse($services as $idx => $service)
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="{{ $idx * 150 }}ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="{{ $service->icon }}" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading"><a href="#">{{ $service->name }}</a></h5>
                    <div class="service-block_one-text">{{ $service->description }}</div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">Belum ada layanan terdaftar.</div>
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
            <div class="sec-title_text">Dukungan Anda sangat berarti bagi keberlangsungan program dan kesejahteraan anak asuh.</div>
        </div>
        <div class="row clearfix">

            @forelse($donations as $idx => $donation)
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="{{ $idx * 150 }}ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="{{ $donation->fa_icon ?? $donation->icon }}" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">{{ $donation->name }}</h5>
                    <div class="featured-block_one-text">{{ $donation->description }}</div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">Belum ada informasi donasi.</div>
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
            <h2 class="sec-title_heading">Informasi Kontak <br> {{ $program->name }}</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang program, donasi, atau kunjungan, silakan hubungi kami melalui kontak di bawah ini.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Contact Info Block -->
            @if($program->phone)
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
            
            <!-- Contact Info Block -->
            @if($program->email)
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
            
            <!-- Contact Info Block -->
            @if($program->address)
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
                    <form method="post" action="sendemail.php" id="contact-form">
                        
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Nama Lengkap" required="">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Alamat Email" required="">
                        </div>
                        
                        <div class="form-group">
                            <textarea class="" name="message" placeholder="Ketik pesanmu di sini"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <!-- Button Box -->
                            <div class="button-box">
                                <button type="submit" class="theme-btn btn-style-four">
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