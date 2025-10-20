@extends('layouts.app')

@section('title', ($program->title ?? $program->name) . ' - Yayasan Al-Munawwar')
@section('description', $program->summary ?? Str::limit(strip_tags($program->description ?? ''), 160))

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
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
    <div class="auto-container mt-4">
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
                <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                    <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="{{ $idx * 150 }}ms" data-wow-duration="1000ms">
                        <div class="featured-block_one-icon"><i class="{{ $facility->icon }}" style="font-size: 48px; color: #28a745;"></i></div>
                        <h5 class="featured-block_one-heading">{{ $facility->name }}</h5>
                        <div class="featured-block_one-text">{{ $facility->description }}</div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Belum ada fasilitas terdaftar.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="contact-one" style="padding: 120px 0;">
    <div class="auto-container">
        <div class="sec-title centered">
            <div class="sec-title_title">HUBUNGI KAMI</div>
            <h2 class="sec-title_heading">Informasi Kontak</h2>
            <div class="sec-title_text">Hubungi kami untuk informasi pendaftaran atau konsultasi.</div>
        </div>
        <div class="row clearfix">
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
    </div>
</section>

</div>
@endsection