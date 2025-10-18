@extends('layouts.app')

@section('title', 'Sejarah - Yayasan Al-Munawwar')
@section('description', 'Pelajari sejarah panjang Yayasan Al-Munawwar dalam melayani pendidikan Islam dan pemberdayaan masyarakat sejak didirikan.')
@section('keywords', 'sejarah yayasan al-munawwar, sejarah pendidikan islam, latar belakang yayasan, perjalanan yayasan')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image:url({{ $bannerUrl ?? asset('images/background/page-title.jpg') }})">
    <div class="auto-container">
        <h2>Sejarah</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>Sejarah</li>
        </ul>
        @if(!empty($errorMessage))
            <div class="alert alert-warning" style="margin-top: 10px;">{{ $errorMessage }}</div>
        @endif
    </div>
</section>
<!-- End Page Title -->

<!-- Welcome Two -->
<section class="welcome-two">
    <div class="welcome-two_pattern" style="background-image:url(assets/images/background/welcome-two_pattern.png)"></div>
    <div class="welcome-two_pattern-two" style="background-image:url(assets/images/background/welcome-two_pattern-two.png)"></div>
    <div class="auto-container">
        <div class="row clearfix">

            <!-- Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_dots" style="background-image:url(assets/images/background/pattern-2.png)"></div>
                    <div class="welcome-two_dots-two" style="background-image:url(assets/images/background/pattern-2.png)"></div>
                    
                    <div class="welcome-two_image">
                        <img src="{{ $imageUrl ?? asset('assets/images/resource/welcome-1.jpg') }}" alt="{{ $history->image_description ?? '' }}" />
                    </div>
                    <div class="welcome-two_years d-flex align-items-center flex-wrap">
                        <span class="fa-solid fa-calendar fa-fw"></span>
                        {{ $history->image_description ?? 'Perjalanan Panjang Al-Munawwar' }}
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title d-flex align-items-center">{{ $history->name ?? 'Sejarah Yayasan' }} <span><img src="assets/images/icons/bismillah-2.png" alt="" /></span></div>
                        <h2 class="sec-title_heading">{{ $history->title ?? 'Perjalanan Panjang Al-Munawwar' }}</h2>
                        <div class="sec-title_text">{!! \App\Helpers\TinyMCEHelper::sanitizeContent($history->description ?? '') !!}</div>  
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Welcome Two -->

<!-- Institute One -->
<section class="institute-one style-two mb-5">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">Perjalanan Sejarah</div>
            <h2 class="sec-title_heading">Tonggak Penting <br> Yayasan Al-Munawwar</h2>
        </div>
        <div class="row clearfix">

            @php $colors = ['', 'color-two', 'color-three', 'color-four']; @endphp
            @forelse($milestones as $index => $milestone)
                @php $delay = 150 + ($index % 3) * 150; @endphp
                <div class="institute-block_one {{ $colors[$index % count($colors)] }} col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="{{ $delay }}ms" data-wow-duration="1000ms">
                        <div class="institute-block_one-bismillah" style="background-image:url(assets/images/icons/bismillah-5.png)"></div>
                        <div class="institute-block_one-icon {{ $milestone->icon }}"></div>
                        <h4 class="institute-block_one-heading">{{ $milestone->title }}</h4>
                        <div class="institute-block_one-text">{{ $milestone->description }}</div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Belum ada tonggak sejarah.</div>
            @endforelse

        </div>
    </div>
</section>

<!-- End Students One -->
@endsection