@extends('layouts.app')

@section('title', ($program->title ?? $program->name) . ' - Yayasan Al-Munawwar')
@section('description', $program->summary ?? Str::limit(strip_tags($program->description ?? ''), 160))

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
<style>
.service-one .row.clearfix{align-items:stretch}
.service-block_one{display:flex}
.service-block_one-inner{display:flex;flex-direction:column;height:100%}
</style>
@endpush

@section('content')
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

<script>
document.addEventListener('DOMContentLoaded',function(){
  function equalizeEducationHeights(){
    var cards=document.querySelectorAll('.service-one .service-block_one-inner');
    var max=0;
    cards.forEach(function(c){c.style.minHeight='auto'});
    cards.forEach(function(c){var h=c.offsetHeight;if(h>max)max=h});
    cards.forEach(function(c){c.style.minHeight=max+'px'});
  }
  setTimeout(equalizeEducationHeights,100);
  window.addEventListener('resize',function(){setTimeout(equalizeEducationHeights,100)});
});
</script>

<div class="green-theme">

<!-- Welcome / Intro -->
<section class="welcome-two" style="padding: 120px 0; position: relative;">
    <div class="pattern-layer" style="background-image:url({{ asset('assets/images/background/pattern-1.png') }});"></div>
    <div class="pattern-layer-two" style="background-image:url({{ asset('assets/images/background/pattern-2.png') }});"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ $photoUrl ?? asset('images/resource/welcome-1.jpg') }}" alt="{{ $program->name }}" />
                    </div>
                </div>
            </div>
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
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

<!-- CTA: Brochure -->
@if($brochureUrl)
<section class="cta-one">
    <div class="auto-container mb-4">
        <div class="inner-container d-flex justify-content-between align-items-center flex-wrap">
            <div class="cta-one_bg" style="background-image:url({{ asset('assets/images/background/cta-one_bg.png') }})"></div>
            <h3 class="cta-one_heading">Unduh brosur untuk informasi lengkap.</h3>
            <div class="cta-one_button">
                <a href="{{ $brochureUrl }}" class="theme-btn btn-style-one" target="_blank" rel="noopener">
                    <span class="btn-wrap">
                        <span class="text-one">Unduh Brosur</span>
                        <span class="text-two">Unduh Brosur</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Program Educations -->
<section class="service-one" style="background-image:url({{ asset('assets/images/background/service-bg.png') }}); padding: 120px 0;">
    <div class="auto-container">
        <div class="sec-title centered">
            <div class="sec-title_title ">PROGRAM UNGGULAN</div>
            <h2 class="sec-title_heading whiteText">Program Pendidikan</h2>
            @if(!empty($program->description))
                <div class="sec-title_text whiteText">{!! $program->description !!}</div>
            @endif
        </div>
        <div class="row clearfix">
            @forelse($educations as $idx => $education)
                <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="{{ $idx * 150 }}ms" data-wow-duration="1000ms">
                        <div class="service-block_one-upper">
                            <div class="service-block_one-icon">
                                <i class="{{ $education->icon }}"></i>
                            </div>
                            <h4 class="service-block_one-heading"><a href="#">{{ $education->name }}</a></h4>
                            <div class="service-block_one-text">{{ $education->description }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Belum ada program pendidikan terdaftar.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Curriculum Section -->
<section class="about-one" aria-labelledby="curriculum-title" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Judul Section -->
        <div class="sec-title centered">
            <div class="sec-title_title">KURIKULUM</div>
            <h2 id="curriculum-title" class="sec-title_heading">Kurikulum Program</h2>
        </div>

        <!-- Konten Kurikulum -->
        <div class="row clearfix">
            <div class="about-one_content-column col-lg-10 col-md-12 col-sm-12 mx-auto">
                <article class="inner-column">
                    @if(!empty($program->curriculum))
                        <div class="content">
                            <div class="sec-title_text">
                                {!! $program->curriculum !!}
                            </div>
                        </div>
                    @else
                        <!-- Fallback jika kurikulum kosong -->
                        <div class="content">
                            <p class="text-muted">Kurikulum belum tersedia untuk program ini.</p>
                        </div>
                    @endif
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Facilities -->
<section class="featured-one" style="padding: 120px 0;">
    <div class="auto-container">
        <div class="sec-title centered">
            <div class="sec-title_title">FASILITAS</div>
            <h2 class="sec-title_heading">Fasilitas Pendukung Pembelajaran</h2>
            <div class="sec-title_text">Fasilitas modern untuk mendukung proses pembelajaran yang optimal dan menyenangkan.</div>
        </div>
        <div class="row clearfix">
            @forelse($facilities as $idx => $facility)
                <!-- Quran Services Card UI -->
                <div class="service-block_two col-lg-4 col-md-6 col-sm-12">
                    <div class="service-block_two-inner wow fadeInLeft" data-wow-delay="{{ $idx * 150 }}ms" data-wow-duration="1000ms">
                        <div class="service-block_two-upper">
                            <div class="service-block_two-icon {{ $facility->icon }}"></div>
                            <div class="service-block_two-big_icon">
                                <img src="{{ asset('assets/images/icons/featured-1.png') }}" alt="" />
                            </div>
                            <h4 class="service-block_two-heading">{{ $facility->name }}</h4>
                            <div class="service-block_two-text">{{ $facility->description }}</div>
                        </div>
                        <div class="service-block_two-lower"></div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Belum ada fasilitas terdaftar.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="contact-info" style="padding-bottom: 120px;">
    <div class="auto-container">
        <div class="sec-title centered">
            <div class="sec-title_title">HUBUNGI KAMI</div>
            <h2 class="sec-title_heading">Informasi Kontak</h2>
            <div class="sec-title_text">Hubungi kami untuk informasi pendaftaran atau konsultasi.</div>
        </div>
        <div class="inner-container">
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
<!-- End Contact Info -->


</div>
@endsection