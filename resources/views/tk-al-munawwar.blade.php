@extends('layouts.app')

@section('title', 'TK Al Munawwar - Yayasan Al-Munawwar')
@section('description', 'TK Al Munawwar adalah unit pendidikan anak usia dini yang mengintegrasikan kurikulum nasional dengan nilai-nilai Islam.')
@section('keywords', 'TK Al Munawwar, PAUD, pendidikan anak usia dini, Islam, Yayasan Al-Munawwar')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

@section('content')
<div class="green-theme">
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('images/background/page-title.jpg') }});">
    <div class="auto-container">
        <h2>TK Al Munawwar</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>TK Al Munawwar</li>
        </ul>
    </div>
</section>



<!-- Welcome Section -->
<section class="welcome-two" style="padding: 120px 0;">
    <div class="welcome-two_pattern" style="background-image:url({{ asset('assets/images/background/pattern-1.png') }})"></div>
    <div class="welcome-two_pattern-two" style="background-image:url({{ asset('assets/images/background/pattern-2.png') }})"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_ameen">
                        <img src="{{ asset('assets/images/icons/ameen-1.png') }}" alt="" />
                    </div>
                    <div class="welcome-two_image">
                        <img src="{{ asset('images/resource/welcome-1.jpg') }}" alt="TK Al Munawwar" />
                    </div>
                    <div class="welcome-two_years d-flex align-items-center flex-wrap">
                        <span class="fa-solid fa-graduation-cap fa-fw"></span>
                        Pendidikan Anak Usia Dini Berkualitas
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title d-flex align-items-center">Pendidikan Anak Usia Dini <span><img src="{{ asset('assets/images/icons/bismillah-2.png') }}" alt="" /></span></div>
                        <h2 class="sec-title_heading">TK Al Munawwar</h2>
                        <div class="sec-title_text">TK Al Munawwar adalah unit pendidikan anak usia dini yang mengintegrasikan kurikulum nasional dengan nilai-nilai Islam untuk membentuk karakter anak yang berakhlak mulia sejak dini.</div>
                    </div>
                    <div class="welcome-two_middle-content">
                        <div class="welcome-two_learn">
                            <span class="welcome-two_learn-icon"><i class="fas fa-graduation-cap" style="font-size: 24px; color: #28a745;"></i></span>
                            Kurikulum Terintegrasi <br> Nasional & Islam
                        </div>
                        <div class="welcome-two_learn">
                            <span class="welcome-two_learn-icon"><i class="fas fa-book" style="font-size: 24px; color: #28a745;"></i></span>
                            Pembelajaran Aktif <br> & Menyenangkan
                        </div>
                    </div>
                    <div class="welcome-two_middle-lower d-flex align-items-center flex-wrap">
                        <div class="welcome-two_thumb">
                            <img src="{{ asset('assets/images/resource/welcome-3.jpg') }}" alt="" />
                        </div>
                        <h5 class="welcome-two_title">Komitmen</h5>
                        <p>Membentuk generasi yang cerdas, kreatif, dan berakhlak mulia melalui pendidikan holistik yang berkualitas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Section -->
<section class="service-one" style="background-image:url({{ asset('assets/images/background/service-bg.png') }}); padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">PROGRAM UNGGULAN</div>
            <h2 class="sec-title_heading">Program Pendidikan <br> TK Al Munawwar</h2>
            <div class="sec-title_text">Program-program unggulan yang dirancang khusus untuk perkembangan optimal anak usia dini dengan pendekatan holistik dan Islami.</div>
        </div>
        <div class="row clearfix">

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon">
                            <i class="fas fa-quran" style="font-size: 24px; color: #2e7d32;"></i>
                        </div>
                        <h4 class="service-block_one-heading"><a href="#">Tahfidz <br> Al-Quran</a></h4>
                        <div class="service-block_one-text">Program menghafal Al-Quran dengan metode yang menyenangkan dan sesuai dengan perkembangan anak usia dini.</div>
                    </div>
                    <div class="service-block_one-lower">
                        <ul class="service-block_one-list">
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Metode bermain sambil belajar</li>
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Pendampingan ustadz/ustadzah berpengalaman</li>
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Target hafalan sesuai kemampuan anak</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon">
                            <i class="fas fa-book-open" style="font-size: 24px; color: #2e7d32;"></i>
                        </div>
                        <h4 class="service-block_one-heading"><a href="#">Calistung <br> Dasar</a></h4>
                        <div class="service-block_one-text">Program membaca, menulis, dan berhitung dengan pendekatan yang menyenangkan dan interaktif.</div>
                    </div>
                    <div class="service-block_one-lower">
                        <ul class="service-block_one-list">
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Metode phonics untuk membaca</li>
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Latihan motorik halus untuk menulis</li>
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Konsep matematika dasar</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon">
                            <i class="fas fa-graduation-cap" style="font-size: 24px; color: #2e7d32;"></i>
                        </div>
                        <h4 class="service-block_one-heading"><a href="#">Persiapan <br> Sekolah Dasar</a></h4>
                        <div class="service-block_one-text">Program khusus mempersiapkan anak untuk memasuki jenjang pendidikan sekolah dasar dengan percaya diri.</div>
                    </div>
                    <div class="service-block_one-lower">
                        <ul class="service-block_one-list">
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Kesiapan akademik dan sosial</li>
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Kemandirian dan tanggung jawab</li>
                            <li><i class="fas fa-check" style="color: #2e7d32; margin-right: 8px;"></i>Adaptasi lingkungan sekolah</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Fasilitas Section -->
<section class="featured-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">FASILITAS</div>
            <h2 class="sec-title_heading">Fasilitas Pendukung <br> Pembelajaran</h2>
            <div class="sec-title_text">Fasilitas lengkap dan modern untuk mendukung proses pembelajaran yang optimal dan menyenangkan bagi anak-anak.</div>
        </div>
        <div class="row clearfix">

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-book-open" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Ruang Kelas <br> Nyaman</h5>
                    <div class="featured-block_one-text">Ruang kelas ber-AC dengan desain ramah anak dan peralatan pembelajaran modern.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-child" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Area Bermain <br> Outdoor</h5>
                    <div class="featured-block_one-text">Playground yang aman dan menyenangkan untuk mengembangkan motorik kasar anak.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-book-reader" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Perpustakaan <br> Mini</h5>
                    <div class="featured-block_one-text">Koleksi buku cerita dan edukatif untuk menumbuhkan minat baca sejak dini.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-clinic-medical" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Ruang <br> Kesehatan</h5>
                    <div class="featured-block_one-text">Fasilitas kesehatan dengan tenaga medis untuk menjaga kesehatan anak-anak.</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-info-section">
    <div class="auto-container">
        <div class="sec-title text-center">
            <h2>Informasi Kontak</h2>
            <div class="text">Hubungi kami untuk informasi lebih lanjut tentang TK Al Munawwar</div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-block">
                    <div class="inner">
                        <div class="icon">
                            <i class="fas fa-phone" style="font-size: 48px; color: #28a745;"></i>
                        </div>
                        <h4>Telepon</h4>
                        <div class="text">
                            <a href="tel:+62123456789">+62 123 456 789</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-block">
                    <div class="inner">
                        <div class="icon">
                            <i class="fas fa-envelope" style="font-size: 48px; color: #28a745;"></i>
                        </div>
                        <h4>Email</h4>
                        <div class="text">
                            <a href="mailto:tk@almunawwar.sch.id">tk@almunawwar.sch.id</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-block">
                    <div class="inner">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt" style="font-size: 48px; color: #28a745;"></i>
                        </div>
                        <h4>Alamat</h4>
                        <div class="text">
                            Jl. Pendidikan No. 123<br>
                            Bogor Raya, Jawa Barat 40123<br>
                            Indonesia 12345
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection