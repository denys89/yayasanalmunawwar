@extends('layouts.app')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image:url({{ $bannerUrl ?? asset('images/background/page-title.jpg') }})">
    <div class="auto-container">
        <h2>Struktur Organisasi</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>Struktur Organisasi</li>
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

.green-theme .quote-box::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 60px;
    color: #C5E96B;
    font-family: serif;
    line-height: 1;
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="org-pattern" width="50" height="50" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1.5" fill="%23C5E96B" opacity="0.15"/><circle cx="12.5" cy="37.5" r="1" fill="%23379452" opacity="0.1"/><circle cx="37.5" cy="12.5" r="1" fill="%23379452" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23org-pattern)"/></svg>');
    opacity: 0.4;
    pointer-events: none;
}

.green-theme .institute-block_one {
    margin-bottom: 40px;
}

.green-theme .institute-block_one-inner {
    background: transparent !important;
    border: none;
    border-radius: 20px;
    padding: 0;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    min-height: 320px;
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
    opacity: 0;
    animation: shimmer 1.5s ease-in-out;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.green-theme .institute-block_one-inner:hover {
  
}

.green-theme .institute-block_one-inner:hover .institute-block_one-heading a,
.green-theme .institute-block_one-inner:hover .institute-block_one-text {
  color: #666 !important;
}

.green-theme .institute-block_one-icon {
    color: #379452;
    font-size: 65px;
    margin-bottom: 30px;
    transition: all 0.3s ease;
}

.green-theme .institute-block_one-inner:hover .institute-block_one-icon {
   
    transform: scale(1.1) rotate(5deg);
}

.green-theme .institute-block_one-heading {
    margin-bottom: -15px;
}

.green-theme .institute-block_one-heading a {
    font-size: 24px;
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
    position: relative;
}

.green-theme .students-one::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(197, 233, 107, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(55, 148, 82, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.green-theme .counter-block_one {
    margin-bottom: 40px;
}

.green-theme .counter-block_one-inner {
    background: linear-gradient(135deg, #f0f8e8 0%, #ffffff 100%);
    border: 3px solid #C5E96B;
    border-radius: 25px;
    padding: 55px 30px;
    text-align: center;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    min-height: 320px;
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
    transform: scale(1.08) rotate(-2deg);
    box-shadow: 0 30px 70px rgba(197, 233, 107, 0.5);
    border-color: #379452;
}

.green-theme .counter-block_one-inner:hover .counter-block_one-title,
.green-theme .counter-block_one-inner:hover .counter-block_one-text {
    color: #ffffff !important;
}

.green-theme .counter-block_one-icon {
    color: #379452;
    font-size: 70px;
    margin-bottom: 35px;
    transition: all 0.3s ease;
    font-family: "flaticon_afbd3404a2e1104832d0";
}

.green-theme .counter-block_one-inner:hover .counter-block_one-icon {
    color: #ffffff;
    transform: scale(1.2) rotateY(180deg);
}

.green-theme .counter-block_one-title {
    color: #379452;
    font-size: 26px;
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
    
    .green-theme .institute-block_one-inner {
        min-height: 280px;
    }
    
    .green-theme .counter-block_one-inner {
        min-height: 280px;
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
        padding: 40px 25px;
    }
    
    .green-theme .institute-block_one-icon,
    .green-theme .counter-block_one-icon {
        font-size: 55px;
    }
    
    .green-theme .institute-block_one-heading a {
        font-size: 20px;
    }
    
    .green-theme .counter-block_one-title {
        font-size: 22px;
    }
}

@media (max-width: 575px) {
    .green-theme .quote-box {
        padding: 25px 20px;
    }
    
    .green-theme .quote-box::before {
        font-size: 45px;
        top: -5px;
        left: 15px;
    }
}
</style>

<div class="green-theme">

    <!-- Welcome One -->
    <style>
    
        .org-hero__content {
            max-width: 640px;
            margin: 0 auto;
            padding: 0.75rem 0;
        }
        .org-hero__title .sec-title_title { margin-bottom: .25rem; }
        .org-hero__title .sec-title_heading {
            margin: 0 0 .75rem 0;
            line-height: 1.25;
        }
        .org-hero__text h4 { margin-bottom: .5rem; }
        .org-hero__text p { margin-bottom: .75rem; }
        .org-hero__quote {
            margin-top: .75rem;
            padding-left: .75rem;
            border-left: 3px solid #e9f5ef;
        }
        .org-hero__image-outer {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }
        .org-hero__image {
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,.08);
        }
    </style>
    <section class="welcome-one">
        <div class="auto-container">
            @if(!empty($errorMessage))
                <div class="alert alert-warning" role="alert">{{ $errorMessage }}</div>
            @endif
            <div class="row clearfix org-hero">
                <!-- Content Column -->
                <div class="welcome-one_content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="welcome-one_content-inner org-hero__content">
                        <!-- Sec Title -->
                        <div class="sec-title org-hero__title">
                            <div class="sec-title_title">{{ $organizationalStructure->name ?? 'Struktur Organisasi' }}</div>
                            <h2 class="sec-title_heading">{{ $organizationalStructure->title ?? 'Tata Kelola ' }}<span>Organisasi</span>{{ ($organizationalStructure && $organizationalStructure->title) ? '' : ' yang Profesional' }}</h2>
                            <div class="sec-title_text">{!! \App\Helpers\TinyMCEHelper::sanitizeContent($organizationalStructure->description ?? 'Yayasan Al-Munawwar memiliki struktur organisasi yang jelas, profesional, dan akuntabel untuk memastikan tata kelola yang baik dalam menjalankan amanah pendidikan dan dakwah Islam.') !!}</div>
                        </div>
                        
                        <div class="welcome-one_text org-hero__text">
                            <h4>Prinsip Tata Kelola</h4>
                            <p>{!! \App\Helpers\TinyMCEHelper::sanitizeContent($organizationalStructure->governance_principles ?? 'Struktur organisasi kami dibangun berdasarkan prinsip transparansi, akuntabilitas, dan profesionalisme dalam menjalankan amanah pendidikan dan dakwah sesuai dengan nilai-nilai Islam.') !!}</p>
                            
                            <div class="quote-box org-hero__quote">
                                <p>
                                    <i class="fa fa-quote-left"></i>
                                    {!! \App\Helpers\TinyMCEHelper::sanitizeContent($organizationalStructure->quran_quote ?? '') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Column -->
                <div class="welcome-one_image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="welcome-two_image-inner">
                        <div class="welcome-two_image-outer org-hero__image-outer">
                            <img class="org-hero__image" src="{{ $imageUrl ?? asset('images/resource/welcome-1.jpg') }}" alt="Struktur Organisasi Yayasan Al-Munawwar" onerror="this.src='{{ asset('images/resource/about-3.png') }}'" />
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
                <div class="sec-title_title">Hierarki Organisasi</div>
                <h2 class="sec-title_heading">Struktur <span>Kepemimpinan</span> Yayasan</h2>
                <div class="sec-title_text">Susunan organisasi yang terstruktur dan hierarkis untuk mencapai tujuan yayasan secara efektif dan efisien</div>
            </div>
            <!--
                Komponen Kartu Anggota Organisasi (dinamis)
                - Menampilkan foto, nama (title), dan jabatan (position)
                - Konsisten dengan tema: memakai grid Bootstrap (col-*) dan
                  gaya kartu `.institute-block_one-inner` yang sudah ada.
                - Foto menggunakan utilitas global `util-thumb` untuk rasio/ukuran seragam.
                - Data bersumber dari koleksi `$foundationLeadershipStructures` yang dikirim controller (type: foundation).
            -->
            <div class="row clearfix">
                @php
                    // Data dari controller: koleksi foundation leadership structures dengan kolom ['photo','title','position','type']
                    $members = isset($foundationLeadershipStructures) ? $foundationLeadershipStructures : collect();
                @endphp

                @if(isset($errorMessage) && $errorMessage)
                    <div class="col-12 text-center" style="color:#d33;">{{ $errorMessage }}</div>
                @else
                    @forelse($members as $index => $leader)
                        @php
                            $photo = $leader->photo ?? null;
                            $isExternal = $photo && Str::startsWith($photo, ['http://', 'https://']);
                            $imgSrc = $photo ? ($isExternal ? $photo : asset('storage/' . $photo)) : asset('assets/images/resource/course-dummy1.png');
                        @endphp
                        <div class="institute-block_one col-lg-3 col-md-4 col-sm-6">
                            <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="{{ 120 * ($index + 1) }}ms" data-wow-duration="1000ms">
                                <!-- Foto profil: rasio persegi seragam -->
                                <div class="mb-3">
                                    <img class="util-thumb" src="{{ $imgSrc }}" alt="Foto {{ $leader->title ?? 'Anggota Organisasi' }}" onerror="this.src='{{ asset('assets/images/resource/course-dummy1.png') }}'" />
                                </div>
                                <!-- Nama lengkap (menggunakan kolom 'title') -->
                                <h5 class="institute-block_one-heading">{{ $leader->title }}</h5>
                                <!-- Jabatan (menggunakan kolom 'position') -->
                                <div class="institute-block_one-text">{{ $leader->position }}</div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback: tampilkan placeholder jika belum ada data -->
                        <div class="col-12 text-center text-muted">Belum ada data struktur kepemimpinan yayasan yang ditambahkan.</div>
                    @endforelse
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
                <div class="sec-title_title">Hierarki Organisasi</div>
                <h2 class="sec-title_heading">Struktur <span>Kepemimpinan</span> Sekolah</h2>
                <div class="sec-title_text">Susunan organisasi yang terstruktur dan hierarkis untuk mencapai tujuan sekolah secara efektif dan efisien</div>
            </div>
            <div class="row clearfix">
                @php
                    // Data dari controller: koleksi school leadership structures dengan kolom ['photo','title','position','type']
                    $members = isset($schoolLeadershipStructures) ? $schoolLeadershipStructures : collect();
                @endphp

                @if(isset($errorMessage) && $errorMessage)
                    <div class="col-12 text-center" style="color:#d33;">{{ $errorMessage }}</div>
                @else
                    @forelse($members as $index => $leader)
                        @php
                            $photo = $leader->photo ?? null;
                            $isExternal = $photo && Str::startsWith($photo, ['http://', 'https://']);
                            $imgSrc = $photo ? ($isExternal ? $photo : asset('storage/' . $photo)) : asset('assets/images/resource/course-dummy1.png');
                        @endphp
                        <div class="institute-block_one col-lg-3 col-md-4 col-sm-6">
                            <div class="institute-block_one-inner wow fadeInLeft" data-wow-delay="{{ 120 * ($index + 1) }}ms" data-wow-duration="1000ms">
                                <!-- Foto profil: rasio persegi seragam -->
                                <div class="mb-3">
                                    <img class="util-thumb" src="{{ $imgSrc }}" alt="Foto {{ $leader->title ?? 'Anggota Organisasi' }}" onerror="this.src='{{ asset('assets/images/resource/course-dummy1.png') }}'" />
                                </div>
                                <!-- Nama lengkap (menggunakan kolom 'title') -->
                                <h5 class="institute-block_one-heading">{{ $leader->title }}</h5>
                                <!-- Jabatan (menggunakan kolom 'position') -->
                                <div class="institute-block_one-text">{{ $leader->position }}</div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback: tampilkan placeholder jika belum ada data -->
                        <div class="col-12 text-center text-muted">Belum ada data struktur kepemimpinan sekolah yang ditambahkan.</div>
                    @endforelse
                @endif
            </div>
        </div>
    </section>
    <!-- End Students One -->
</div>
@endsection