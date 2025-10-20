@extends('layouts.app')

@section('title', 'Masjid Al Munawwar - Yayasan Al-Munawwar')
@section('description', 'Masjid Al Munawwar adalah pusat kegiatan ibadah dan dakwah yang melayani masyarakat dengan berbagai program keagamaan dan sosial.')
@section('keywords', 'Masjid Al Munawwar, ibadah, dakwah, kajian Islam, sholat, Yayasan Al-Munawwar')

@section('content')
@push('styles')
<link rel="stylesheet" href="{{ asset('style/custom.css') }}">
@endpush

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('images/background/page-title.jpg') }});">
    <div class="auto-container">
        <h2>Masjid Al Munawwar</h2>
        <ul class="bread-crumb clearfix">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li>Masjid Al Munawwar</li>
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
                        <img src="{{ asset('images/resource/welcome-1.jpg') }}" alt="Panti Al Munawwar" />
                    </div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="welcome-two_content-column col-lg-6 col-md-12 col-sm-12">
                <div class="welcome-two_content-outer">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        <div class="sec-title_title">MASJID AL MUNAWWAR</div>
                        <h2 class="sec-title_heading">Pusat Ibadah & Dakwah <br> Umat Islam</h2>
                        <div class="sec-title_text">Masjid Al Munawwar adalah pusat kegiatan ibadah dan dakwah yang melayani masyarakat dengan berbagai program keagamaan, sosial, dan pendidikan untuk memperkuat ukhuwah Islamiyah dan membangun generasi yang beriman dan bertakwa.</div>
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
            <h2 class="sec-title_heading">Program Ibadah & Dakwah <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Berbagai kegiatan dan layanan yang tersedia di Masjid Al Munawwar untuk memenuhi kebutuhan spiritual dan sosial umat Islam.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-praying-hands" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Sholat Berjamaah</h5>
                    <div class="service-block_one-text">Sholat lima waktu berjamaah dengan imam yang berpengalaman dan suara yang merdu dalam suasana yang khusyuk.</div>
                   
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-quran" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Kajian Al-Quran</h5>
                    <div class="service-block_one-text">Kajian tafsir Al-Quran dan hadits yang diselenggarakan rutin untuk memperdalam pemahaman agama.</div>
                    
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-moon" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Program Ramadhan</h5>
                    <div class="service-block_one-text">Kegiatan khusus bulan Ramadhan untuk meningkatkan ketakwaan dan kebersamaan umat.</div>
                   
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-graduation-cap" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">TPA/TPQ</h5>
                    <div class="service-block_one-text">Taman Pendidikan Al-Quran untuk anak-anak belajar membaca Al-Quran dengan metode yang menyenangkan.</div>
                    
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-ring" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Akad Nikah</h5>
                    <div class="service-block_one-text">Pelayanan akad nikah dengan prosedur yang sesuai syariat Islam dalam suasana yang sakral.</div>
                    
                </div>
            </div>
            
            <!-- Service Block One -->
            <div class="service-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="service-block_one-inner wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1000ms">
                    <div class="service-block_one-icon"><i class="fas fa-hand-holding-heart" style="font-size: 24px; color: #28a745;"></i></div>
                    <h5 class="service-block_one-heading">Zakat & Infaq</h5>
                    <div class="service-block_one-text">Pengelolaan zakat, infaq, dan sedekah untuk disalurkan kepada yang berhak dengan transparan.</div>
                    
                </div>
            </div>
            
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
                    <div class="institute-block_one-icon"><i class="fas fa-praying-hands" style="font-size: 24px; color: #28a745;"></i></div>
                    <h4 class="institute-block_one-heading">Jadwal Sholat Harian</h4>
                    <div class="institute-block_one-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>
                </div>
            </div>
            
            <!-- Institute Block One -->
            <div class="institute-block_one col-lg-6 col-md-12 col-sm-12">
                <div class="institute-block_one-inner">
                    <div class="institute-block_one-icon"><i class="fas fa-calendar-alt" style="font-size: 24px; color: #28a745;"></i></div>
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
<section class="featured-one" style="padding: 120px 0;">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <div class="sec-title_title">CARA BERDONASI</div>
            <h2 class="sec-title_heading">Masjid Al Munawwar</h2>
            <div class="sec-title_text">Berbagai cara mudah untuk berdonasi ke Masjid Al Munawwar.</div>
        </div>
        <div class="row clearfix">

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-university" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Transfer Bank</h5>
                    <div class="featured-block_one-text">
                        Bank Mandiri<br>
                        No. Rek: 123-456-789<br>
                        a.n. Yayasan Al-Munawwar
                    </div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-wallet" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">E-Wallet Digital</h5>
                    <div class="featured-block_one-text">
                        GoPay: 0812-3456-7890<br>
                        OVO: 0812-3456-7890<br>
                        DANA: 0812-3456-7890
                    </div>
                </div>
            </div>

            <!-- Featured Block One -->
            <div class="featured-block_one col-lg-4 col-md-6 col-sm-12">
                <div class="featured-block_one-inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="featured-block_one-icon"><i class="fas fa-hand-holding-heart" style="font-size: 48px; color: #28a745;"></i></div>
                    <h5 class="featured-block_one-heading">Donasi Langsung</h5>
                    <div class="featured-block_one-text">
                        Kunjungi langsung kantor<br>
                        Yayasan Al-Munawwar<br>
                        Setiap hari kerja 08:00-16:00
                    </div>
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
            <h2 class="sec-title_heading">Informasi Kontak <br> Masjid Al Munawwar</h2>
            <div class="sec-title_text">Untuk informasi lebih lanjut tentang kegiatan, jadwal sholat, atau program dakwah di Masjid Al Munawwar, silakan hubungi kami.</div>
        </div>
        
        <div class="row clearfix">
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-phone" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Telepon</h4>
                    <div class="contact-info-block_text">
                        <a href="tel:+62123456792">(021) 8765-434</a><br>
                        <a href="tel:+628123456792">0812-3456-792</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-envelope" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Email</h4>
                    <div class="contact-info-block_text">
                        <a href="mailto:masjid@almunawwar.sch.id">masjid@almunawwar.sch.id</a><br>
                        <a href="mailto:takmir@almunawwar.sch.id">takmir@almunawwar.sch.id</a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info Block -->
            <div class="contact-info-block col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-block_inner">
                    <div class="contact-info-block_icon"><i class="fas fa-map-marker-alt" style="font-size: 48px; color: #28a745;"></i></div>
                    <h4 class="contact-info-block_heading">Alamat</h4>
                    <div class="contact-info-block_text">
                        Jl. Masjid Raya No. 129<br>
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