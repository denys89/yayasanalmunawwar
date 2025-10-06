@extends('layouts.app')

@section('title', 'SD Islam Al Munawwar - Yayasan Al-Munawwar')
@section('description', 'SD Islam Al Munawwar adalah sekolah dasar yang mengintegrasikan kurikulum nasional dengan pendidikan Islam untuk membentuk generasi yang berakhlak mulia dan berprestasi.')
@section('keywords', 'SD Islam Al Munawwar, sekolah dasar, pendidikan Islam, kurikulum nasional, Yayasan Al-Munawwar')

@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('images/background/page-title.jpg') }});">
    <div class="auto-container">
            <h2>SD Islam Al Munawwar</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>SD Islam Al Munawwar</li>
            </ul>
    </div>
</section>



<div class="green-theme">

<!-- SD Al Munawwar Section -->
<section class="welcome-two" style="padding: 120px 0; position: relative;">
    <div class="pattern-layer" style="background-image:url({{ asset('assets/images/background/pattern-1.png') }});"></div>
    <div class="pattern-layer-two" style="background-image:url({{ asset('assets/images/background/pattern-2.png') }});"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <!-- Welcome Two Image Column -->
            <div class="welcome-two_image-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_image-outer">
                    <div class="welcome-two_image">
                        <img src="{{ asset('images/resource/welcome-1.jpg') }}" alt="SD Al Munawwar" />
                    </div>
                </div>
            </div>

            <!-- Welcome Two Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">SEKOLAH DASAR ISLAM AL MUNAWWAR</div>
                        <h2 class="sec-title_heading">SD Islam Al Munawwar <br> Pendidikan Berkualitas</h2>
                        <div class="sec-title_text">SD Islam Al Munawwar adalah sekolah dasar yang mengintegrasikan kurikulum nasional dengan pendidikan Islam untuk membentuk generasi yang berakhlak mulia, berprestasi, dan siap menghadapi tantangan masa depan.</div>
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
            <h2 class="sec-title_heading">Program Pendidikan <br> SD Al Munawwar</h2>
            <div class="sec-title_text">Program-program unggulan yang dirancang untuk mengembangkan potensi siswa secara optimal dengan pendekatan holistik dan Islami.</div>
        </div>
        <div class="row clearfix">

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon"><i class="fas fa-quran" style="font-size: 24px; color: #28a745;"></i></div>
                        
                        <h4 class="service-block_one-heading"><a href="#">Tahfidz <br> Al-Quran</a></h4>
                        <div class="service-block_one-text">Program menghafal Al-Quran dengan target hafalan sesuai tingkat kelas dan kemampuan siswa.</div>
                    </div>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon"><i class="fas fa-laptop-code" style="font-size: 24px; color: #28a745;"></i></div>
                        
                        <h4 class="service-block_one-heading"><a href="#">ICT & <br> Coding</a></h4>
                        <div class="service-block_one-text">Pembelajaran teknologi informasi dan dasar-dasar pemrograman untuk mempersiapkan era digital.</div>
                    </div>
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon"><i class="fas fa-language" style="font-size: 24px; color: #28a745;"></i></div>
                        
                        <h4 class="service-block_one-heading"><a href="#">Bahasa Arab <br> & Inggris</a></h4>
                        <div class="service-block_one-text">Program bahasa asing yang intensif untuk mempersiapkan siswa menghadapi era global.</div>
                    </div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon"><i class="fas fa-flask" style="font-size: 24px; color: #28a745;"></i></div>
                        
                        <h4 class="service-block_one-heading"><a href="#">Sains & <br> Matematika</a></h4>
                        <div class="service-block_one-text">Pembelajaran sains dan matematika dengan pendekatan eksperimen dan praktik langsung.</div>
                    </div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon"><i class="fas fa-running" style="font-size: 24px; color: #28a745;"></i></div>
                        
                        <h4 class="service-block_one-heading"><a href="#">Olahraga & <br> Kesehatan</a></h4>
                        <div class="service-block_one-text">Program olahraga dan kesehatan untuk mengembangkan fisik dan mental siswa secara optimal.</div>
                    </div>
                    
                </div>
            </div>

            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1000ms">
                    <div class="service-block_one-upper">
                        <div class="service-block_one-icon"><i class="fas fa-palette" style="font-size: 24px; color: #28a745;"></i></div>
                        
                        <h4 class="service-block_one-heading"><a href="#">Seni & <br> Budaya</a></h4>
                        <div class="service-block_one-text">Mengembangkan bakat seni dan apresiasi budaya melalui berbagai kegiatan kreatif dan ekspresif.</div>
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
            <div class="sec-title_text">SD Al Munawwar dilengkapi dengan fasilitas modern dan lengkap untuk mendukung proses pembelajaran yang optimal dan menyenangkan.</div>
        </div>
        <div class="row clearfix">

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-chalkboard-teacher" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Ruang Kelas <br> Modern</h5>
                    <div class="featured-block_one-text">Ruang kelas ber-AC dengan smart board dan peralatan pembelajaran modern.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-flask" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Laboratorium <br> Lengkap</h5>
                    <div class="featured-block_one-text">Laboratorium komputer dan sains untuk praktik pembelajaran yang interaktif.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-book-open" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Perpustakaan <br> Digital</h5>
                    <div class="featured-block_one-text">Perpustakaan dengan koleksi buku lengkap dan akses digital learning.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-futbol" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Lapangan <br> Olahraga</h5>
                    <div class="featured-block_one-text">Lapangan olahraga dan aula serbaguna untuk kegiatan fisik dan ekstrakurikuler.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-mosque" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Musholla <br> Sekolah</h5>
                    <div class="featured-block_one-text">Musholla yang nyaman untuk kegiatan ibadah dan pembelajaran agama.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-utensils" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Kantin <br> Sehat</h5>
                    <div class="featured-block_one-text">Kantin sehat dengan menu bergizi dan higienis untuk kesehatan siswa.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="900ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-clinic-medical" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Klinik <br> Kesehatan</h5>
                    <div class="featured-block_one-text">Klinik kesehatan dengan tenaga medis profesional untuk menjaga kesehatan siswa.</div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-3 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="1050ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-parking" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Area Parkir <br> Aman</h5>
                    <div class="featured-block_one-text">Area parkir yang luas dan aman dengan sistem keamanan 24 jam.</div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Contact Section -->
<section class="contact-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">HUBUNGI KAMI</div>
            <h2 class="sec-title_heading">Informasi Kontak <br> SD Al Munawwar</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang pendaftaran, kurikulum, dan kegiatan SD Al Munawwar, silakan hubungi kami melalui kontak di bawah ini.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-phone" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Telepon</h4>
                    <div class="contact-info-block_text">
                        <a href="tel:+6221-8765432">(021) 8765-432</a><br>
                        <a href="tel:+628123456789">0812-3456-789</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-envelope" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Email</h4>
                    <div class="contact-info-block_text">
                        <a href="mailto:sd@almunawwar.sch.id">sd@almunawwar.sch.id</a><br>
                        <a href="mailto:info@almunawwar.sch.id">info@almunawwar.sch.id</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-map-marker-alt" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Alamat</h4>
                    <div class="contact-info-block_text">
                        Jl. Pendidikan No. 123<br>
                        Bogor Raya, Jawa Barat 40123<br>
                        Indonesia 12345
                    </div>
                </div>
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
</div>
@endsection