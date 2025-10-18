@extends('layouts.app')

@section('title', 'Visi Misi - Yayasan Al-Munawwar')
@section('description', 'Visi dan misi Yayasan Al-Munawwar dalam mewujudkan pendidikan Islam berkualitas dan pemberdayaan masyarakat yang berkelanjutan.')
@section('keywords', 'visi misi yayasan al-munawwar, tujuan yayasan, pendidikan islam, pemberdayaan masyarakat')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image:url({{ $bannerUrl ?? asset('images/background/page-title.jpg') }})">
    <div class="auto-container">
        <h2>{{ $visionMission->name ?? 'Visi & Misi' }}</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>{{ $visionMission->name ?? 'Visi & Misi' }}</li>
        </ul>
    </div>
</section>
<!-- End Page Title -->

<!-- Custom Green Styling -->
<style>
/* Improved Spacing and Layout */
.green-theme {
    font-family: 'Roboto', sans-serif;
}

.green-theme .sec-title {
    margin-bottom: 50px;
}

.green-theme .sec-title_title {
    background: linear-gradient(90deg, #C5E96B, #379452);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.green-theme .sec-title_heading {
    font-size: 42px;
    line-height: 1.3;
    margin-bottom: 20px;
    font-weight: 700;
}

.green-theme .sec-title_heading span {
    color: #C5E96B !important;
}

.green-theme .sec-title_text {
    font-size: 16px;
    line-height: 1.7;
    color: #666;
    margin-bottom: 0;
}

/* Welcome Section Improvements */
.green-theme .welcome-one {
    padding: 80px 0;
    background: linear-gradient(135deg, #ffffff 0%, #f8fdf4 100%);
}

.green-theme .welcome-one_content-inner {
    padding-right: 40px;
}

.green-theme .welcome-one_text {
    margin-top: 40px;
}

.green-theme .welcome-one_text h4 {
    color: #379452;
    font-size: 28px;
    margin-bottom: 25px;
    font-weight: 700;
    position: relative;
    padding-bottom: 15px;
}

.green-theme .welcome-one_text h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #C5E96B, #379452);
    border-radius: 2px;
}

.green-theme .welcome-one_text p {
    font-size: 16px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 30px;
}

/* Quote Box Styling */
.green-theme .quote-box {
    background: linear-gradient(135deg, #f0f8e8, #ffffff);
    border-left: 5px solid #C5E96B;
    border-radius: 15px;
    padding: 30px;
    margin-top: 35px;
    position: relative;
    box-shadow: 0 8px 25px rgba(197, 233, 107, 0.15);
}

.green-theme .quote-box p {
    margin: 0;
    font-style: italic;
    color: #379452;
    font-size: 16px;
    line-height: 1.6;
}

.green-theme .quote-box .fa-quote-left {
    color: #C5E96B;
    margin-right: 12px;
    font-size: 18px;
}

/* Image Column Improvements */
.green-theme .welcome-one_image {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    position: relative;
    margin-left: 20px;
}

.green-theme .welcome-one_image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(197, 233, 107, 0.1), rgba(55, 148, 82, 0.1));
    z-index: 1;
}

.green-theme .welcome-one_image img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}

.green-theme .welcome-one_image:hover img {
    transform: scale(1.05);
}

/* Institute Section Improvements */
.green-theme .institute-one {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8fdf4 0%, #ffffff 50%, #f0f8e8 100%);
    position: relative;
}

.green-theme .institute-one::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23C5E96B" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23379452" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
    pointer-events: none;
}

.green-theme .institute-block_one {
    margin-bottom: 40px;
}

.green-theme .institute-block_one-inner {
    background: linear-gradient(135deg, #ffffff 0%, #f8fdf4 100%);
    border: 2px solid #e8f5d8;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    min-height: 280px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.green-theme .institute-block_one-inner::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(197, 233, 107, 0.1), transparent);
    transform: rotate(45deg);
    transition: all 0.6s ease;
    opacity: 0;
}

.green-theme .institute-block_one-inner:hover::before {
    opacity: 1;
    animation: shimmer 1.5s ease-in-out;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.green-theme .institute-block_one-inner:hover {
    background: linear-gradient(135deg, #C5E96B 0%, #a2d155 100%);
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(197, 233, 107, 0.4);
    border-color: #C5E96B;
}

.green-theme .institute-block_one-inner:hover .institute-block_one-heading a,
.green-theme .institute-block_one-inner:hover .institute-block_one-text {
    color: #ffffff !important;
}

.green-theme .institute-block_one-icon {
    color: #379452;
    font-size: 60px;
    margin-bottom: 25px;
    transition: all 0.3s ease;
}

.green-theme .institute-block_one-inner:hover .institute-block_one-icon {
    color: #ffffff;
    transform: scale(1.1) rotate(5deg);
}

.green-theme .institute-block_one-heading {
    margin-bottom: 20px;
}

.green-theme .institute-block_one-heading a {
    font-size: 22px;
    font-weight: 700;
    color: #333;
    text-decoration: none;
    transition: all 0.3s ease;
}

.green-theme .institute-block_one-text {
    font-size: 15px;
    line-height: 1.7;
    color: #666;
    transition: all 0.3s ease;
}

/* Students Section Improvements */
.green-theme .students-one {
    padding: 100px 0;
    background: linear-gradient(135deg, #ffffff 0%, #f8fdf4 100%);
}

.green-theme .counter-block_one {
    margin-bottom: 40px;
}

.green-theme .counter-block_one-inner {
    background: linear-gradient(135deg, #f0f8e8 0%, #ffffff 100%);
    border: 3px solid #C5E96B;
    border-radius: 25px;
    padding: 50px 25px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    min-height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.green-theme .counter-block_one-inner::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.green-theme .counter-block_one-inner:hover::after {
    left: 100%;
}

.green-theme .counter-block_one-inner:hover {
    background: linear-gradient(135deg, #C5E96B 0%, #379452 100%);
    transform: scale(1.05) rotate(-1deg);
    box-shadow: 0 25px 60px rgba(197, 233, 107, 0.5);
    border-color: #379452;
}

.green-theme .counter-block_one-inner:hover .counter-block_one-title,
.green-theme .counter-block_one-inner:hover .counter-block_one-text {
    color: #ffffff !important;
}

.green-theme .counter-block_one-icon {
    color: #379452;
    font-size: 65px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    font-family: "flaticon_afbd3404a2e1104832d0";
}

.green-theme .counter-block_one-inner:hover .counter-block_one-icon {
    color: #ffffff;
    transform: scale(1.2) rotateY(180deg);
}

.green-theme .counter-block_one-title {
    color: #379452;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
    transition: all 0.3s ease;
}

.green-theme .counter-block_one-text {
    font-size: 15px;
    line-height: 1.7;
    color: #666;
    transition: all 0.3s ease;
}

/* Responsive Improvements */
@media (max-width: 991px) {
    .green-theme .welcome-one_content-inner {
        padding-right: 0;
        margin-bottom: 50px;
    }
    
    .green-theme .welcome-one_image {
        margin-left: 0;
    }
    
    .green-theme .sec-title_heading {
        font-size: 36px;
    }
    
    .green-theme .welcome-one_text h4 {
        font-size: 24px;
    }
}

@media (max-width: 767px) {
    .green-theme .welcome-one {
        padding: 60px 0;
    }
    
    .green-theme .institute-one,
    .green-theme .students-one {
        padding: 80px 0;
    }
    
    .green-theme .sec-title_heading {
        font-size: 30px;
    }
    
    .green-theme .institute-block_one-inner,
    .green-theme .counter-block_one-inner {
        min-height: auto;
        padding: 35px 25px;
    }
}
</style>

<div class="green-theme">

    <!-- Welcome One -->
    <section class="welcome-one">
        <div class="auto-container">
            @if(!empty($errorMessage))
                <div class="alert alert-warning" role="alert">{{ $errorMessage }}</div>
            @endif
            <div class="row clearfix">
                <!-- Content Column -->
                <div class="welcome-one_content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="welcome-one_content-inner">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <div class="sec-title_title">{{ $visionMission->name ?? 'Visi & Misi Yayasan' }}</div>
                            <h2 class="sec-title_heading">{{ $visionMission->title ?? 'Membangun Generasi Islami yang Berkualitas' }}</h2>
                            <div class="sec-title_text">{!! \App\Helpers\TinyMCEHelper::sanitizeContent($visionMission->description ?? '') !!}</div>
                        </div>
                        
                        <div class="welcome-one_text">
                            <h4>Visi Kami</h4>
                            <p>{{ $visionMission->our_vision ?? 'Menjadi lembaga pendidikan Islam terdepan yang menghasilkan generasi muslim yang beriman, bertakwa, berakhlak mulia, cerdas, dan berdaya saing global dengan landasan nilai-nilai Al-Quran dan As-Sunnah.' }}</p>
                            
                            <div class="quote-box">
                                <p>
                                    <i class="fa fa-quote-left"></i>
                                    {{ $visionMission->quran_quote ?? 'Dan hendaklah ada di antara kamu segolongan umat yang menyeru kepada kebajikan, menyuruh kepada yang ma\'ruf dan mencegah dari yang munkar; merekalah orang-orang yang beruntung.' }}
                                    <strong>{{ $visionMission->quran_quote ? '' : '(QS. Ali Imran: 104)' }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Column -->
                <div class="welcome-one_image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="welcome-two_image-inner">
                        <div class="welcome-two_image-outer">
                            <img src="{{ $imageUrl ?? asset('images/resource/welcome-1.jpg') }}" alt="Visi Misi Yayasan Al-Munawwar" onerror="this.src='{{ asset('images/resource/about-2.jpg') }}'" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Welcome One -->

    <!-- Institute One -->
    <section class="institute-one">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Misi Yayasan</div>
                <h2 class="sec-title_heading">8 Misi Utama <span>Al-Munawwar</span></h2>
                <div class="sec-title_text">Delapan misi strategis yang menjadi panduan dalam mencapai visi yayasan untuk membangun generasi Islami yang unggul</div>
            </div>
            
            <div class="row clearfix">
                @if($missions && $missions->count())
                    @foreach($missions as $index => $mission)
                        <div class="institute-block_one col-lg-4 col-md-6 col-sm-12">
                            <div class="institute-block_one-inner" style="animation-delay: {{ number_format($index * 0.05, 2) }}s;">
                                <div class="institute-block_one-icon {{ $mission->icon ?? 'flaticon-education' }}"></div>
                                <h5 class="institute-block_one-heading"><a href="#">{{ $mission->title }}</a></h5>
                                <div class="institute-block_one-text">{{ $mission->description }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center" style="color:#666;">Belum ada misi ditambahkan.</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End Institute One -->

    <!-- Students One -->
    <section class="students-one">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="sec-title_title">Nilai-Nilai Kami</div>
                <h2 class="sec-title_heading">Nilai Dasar <span>Yayasan</span></h2>
                <div class="sec-title_text">Nilai-nilai fundamental yang menjadi landasan dalam setiap kegiatan dan program yayasan</div>
            </div>
            
            <div class="row clearfix">
                @if($coreValues && $coreValues->count())
                    @foreach($coreValues as $index => $value)
                        <div class="counter-block_one col-lg-3 col-md-6 col-sm-12">
                            <div class="counter-block_one-inner" style="animation-delay: {{ number_format($index * 0.05, 2) }}s;">
                                <div class="counter-block_one-icon {{ $value->icon ?? 'flaticon-education' }}"></div>
                                <div class="counter-block_one-title">{{ $value->title }}</div>
                                <div class="counter-block_one-text">{{ $value->description }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center" style="color:#666;">Belum ada nilai yayasan ditambahkan.</div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End Students One -->
</div>


@endsection